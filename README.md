# Anime API

## Overview
The Anime API is a RESTful API that provides CRUD (Create, Read, Update, Delete) operations for managing anime data. It also includes user authentication features, allowing users to sign up, sign in, and view their profiles.

## Main Functionalities
- **Sign Up:** Users can create a new account by providing their details.
- **Sign In:** Registered users can sign in to access the API's features.
- **Logout:** Users can securely log out from their accounts.
- **Fetch Profile:** Authenticated users can retrieve their profile information.
- **Delete Account:** Users have the option to delete their accounts.
- **Store New Anime:** Authenticated users can add new anime entries to the database.
- **Update Existing Anime:** Users can edit and update existing anime details.
- **Show All Anime:** Users can view a list of all available anime entries.
- **Show Single Anime:** Users can retrieve detailed information about a specific anime.
- **Delete Anime:** Users with appropriate permissions can remove anime entries.

## Installation and Setup

### Requirements
Before setting up the application, ensure that you have the following requirements installed on your system:
- **PHP 8.1:** Ensure that PHP 8.1 or later is installed on your system.
- **XAMPP/Laragon:** Set up XAMPP or Laragon to serve as your local development environment for the database.
- **Composer:** Make sure Composer is installed on your system to manage PHP dependencies.

### Installation Steps
Follow these steps to install and set up the application:

1. **Clone the Repository:**

    ```shell
    git clone https://github.com/RupertC07/lws-exam.git
    

2. **Navigate to Project Directory:**
   
    ```shell
    cd lws-exam
    

3. **Install Dependencies:**
   
    ```shell
    composer install
    

4.  **After Installation Configure Environment Variables:**
    On project directory you will find .env.example copy it and remove '.example'
    On the database part, please ensure that it will be reflected based on your credentials
    Example :
    
       ```shell
            DB_CONNECTION=mysql
            DB_HOST=127.0.0.1
            DB_PORT=3306
            DB_DATABASE=your databasename
            DB_USERNAME=your database username
            DB_PASSWORD=your database/server password
       
       
5. **Extra Configure on Environment Variables:**
   On the bottom part of our env file, you will see a variable named ANIME_APP_API
   That will serve as our api key so not anyone can use the api as long as they have api key and same with
    the server's api key. Fill it based on your preferences
   Ex:
   
    ```shell
        ANIME_API_KEY=Test12345678910

6. **Set Up Your Database Server:**
    Start your Laragon or Xampp
    
7. **Migrate All the Tables from Project Directory:**

    run this to your cmd/bash

    ```shell
        php artisan migrate

8. **Start the server:**

    run this 

    ```shell
    php artisan serve


### Aight! Our project setup is done!



### API DOCUMENTATION

NOTE : all of the api enpoints are secured via x-api-key on the headers so make sure that every request
        included an api key that being stored in your env that we set up


#### Endpoints:


#### Users
- `POST /api/v1/user/`: Create a new user account / Register an account.
- 
    Data needed[via form data] :
      {
          'firstName' : string & required,
          'middleName' : string & nullable,
          'lastName' : string & required,
          'email' : string & email & required,
          'dob' : date & required & in format YYYY-MM-DD
          'contactNumber' : string & required,
          'password' : string & min:8 & required & must be confirmed via pasword_confirmation field 
    }

  Successful response : token
  
- `POST /api/v1/user/auth/`: Log in and obtain an authentication token.

     Data needed[via form data] :
      {
          'email' : string & email & required
          'password' : string & required 
      }

   Successful response : token
      
- `POST /api/v1/user/signout`: Log out and invalidate the authentication token [Secured via bearer token]

  Successful response : success status, message, data, and code
  
- `GET /api/v1/user/`: Get user profile [Secured via bearer token]

    Successful response : user profile
  
- `DELETE /api/v1/user/`: Delete user account [Secured via bearer token]

   Successful response : success status, message, data, and code

#### ANIME

- `GET /api/v1/anime/`: fetch all the available anime[Secured via bearer token].

   Successful response : success status, message, data, and code
  
- `POST /api/v1/anime/`: Store new anime [Secured via bearer token].

   Data needed[via form data] :
      {
          'title' : string & required,
          'description' : string & required,
          'category[index]' : string & required,
          'publisher' : string & nullable,
          'image' : required & image & mime:jpeg,png,jpg,gif & Max 5MB
          'type' : string & required & only allowed [series, movie],
          'status' : string & required & only allowed [On Going, Coming Soon, Ended, Available],
    }

   Successful response : success status, message, data, and code

- `GET /api/v1/anime/{id}`: Get single anime [Secured via bearer token].
    
     Successful response : success status, message, data, and code

- `PUT /api/v1/anime/{id}`: update an existing anime [Secured via bearer token].

  Data needed[via form data] :
      {
          'title' : string & required,
          'description' : string & required,
          'category[index]' : string & required,
          'publisher' : string & nullable,
          'image' : sometimes & image & mime:jpeg,png,jpg,gif & Max 5MB
          'type' : string & required & only allowed [series, movie],
          'status' : string & required & only allowed [On Going, Coming Soon, Ended, Available],
    }

   request must be on POST but it should have a method query for the form data works as usual
  
   example : POST : localhost:3000/api/v1/anime/{id}?_method=PUT
  
   Successful response : success status, message, data, and code


- `DELETE /api/v1/anime/{id}`: Delete an existing anime [Secured via bearer token].

   Successful response : success status, message, data, and code

    




