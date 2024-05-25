# Thoughts Documentation!

![thoughts](https://github.com/Japheth-Joepari/thoughts/assets/51114866/39e5f0ea-f28b-4beb-8f56-ea1cefc8e94c)

This documentation provides an overview and usage guide for the Blog Application. The Blog Application is a web-based platform that allows users to create, read, update, and delete articles. It also provides user authentication through Google and GitHub, comment functionality, and the ability to follow other users. Additionally, users can interact with articles by liking (clapping) and replying to comments.

## Table of Contents

-   [Features](#features)
-   [Prerequisites](#prerequisites)
-   [Installation](#installation)
-   [Usage](#usage)

## Features

The Blog Application offers the following features:

-   **CRUD for Articles**: Users can create, read, update, and delete articles. Each article includes a title, content, author, and publication date.
-   **CRUD for Users**: Users can create, read, update, and delete their profiles. Each user has a username, email, and profile picture.
-   **Authentication**: Users can log in to the application using their Google or GitHub accounts.
-   **Comments**: Users can leave comments on articles and reply to existing comments.
-   **Claps**: Users can like articles by clapping for them.
-   **Following Functionality**: Users can follow other users to receive updates on their activities.

## Prerequisites

Before setting up the Blog Application, ensure that you have the following prerequisites:

-   PHP (minimum version 7.4)
-   Composer
-   Laravel (minimum version 8.x)
-   MySQL or any other supported database management system
-   Google and GitHub developer accounts for configuring OAuth authentication

## Installation

To install and set up the Blog Application, follow these steps:

1. Clone the repository:

    ```bash
    git clone https://github.com/Japheth-Joepari/thoughts.git
    ```

2. Install the dependencies using Composer:

    ```bash
    composer install
    ```

3. Copy the `.env.example` file to `.env` and update the necessary configuration values, including database credentials and OAuth client IDs and secrets.

4. Generate the application key:

    ```bash
    php artisan key:generate
    ```

5. Run the database migrations to create the required tables:

    ```bash
    php artisan migrate
    ```

6. Start the development server:

    ```bash
    php artisan serve
    ```

7. Access the application in your browser at `http://localhost:8000`.

## Usage

Once the Blog Application is installed and running, you can access the various features through the web interface. Here are the main components and functionalities:

-   **Articles**: Users can create new articles, view existing articles, update their own articles, and delete articles they have created. Each article includes a title, content, author information, and publication date.
-   **Users**: Users can create their profiles, view profiles of other users, update their own profiles, and delete their profiles.
-   **Authentication**: Users can log in to the application using their Google or GitHub accounts. This enables them to perform actions like creating articles, leaving comments, and following other users.
-   **Notifications**: Users get to view a list of notifications if the have any .
-   **Comments**: Users can leave comments on articles and reply to existing comments. Comments are displayed in a threaded format, allowing for conversations.
-   **Claps**: Users can show their appreciation for articles by clapping for them. The number of claps received by an article is displayed to users.
-   **Following Functionality**: Users can choose to follow other users to receive updates on their activities, such as new articles and comments.
