# Prep Network Laravel Code Challenge

## Overview

This exercise will have the candidate build CRUD functionality for a sample CRM. If you have any questions or need assistance, please email travis@prepnetwork.com.

## Expectations

After following the instructions below, the final product should allow the user to index a contact list while also having the ability to create, edit, update, and delete a contact.

## Required Dependencies

| Name      | Download                                             |
| --------- | ---------------------------------------------------- |
| PHP       | https://formulae.brew.sh/formula/php                 |
| Node JS   | https://nodejs.org/en                                |
| MySQL     | https://dev.mysql.com/downloads/mysql                |
| Composer  | https://getcomposer.org/download                     |

## Setup

1. Clone the repository and navigate to the root directory:

```
git clone https://github.com/travisanderson99/laravel-code-challenge.git
```

2. Install PHP dependencies using Composer:

```
composer install
```

3. Download dependencies & compile assets:

```
npm install
npm run dev
```

4. Import the SQL database found in the repository root.

5. Copy the .env.example to a new .env file in the root directory and update the database credentials to match your local database.

6. Create the application key and clear the application cache:

```
php artisan key:generate
php artisan optimize
php artisan config:clear
```

7. Serve the site:

```
php artisan serve
```

8. Login:

    **Email:** testuser@prepnetwork.com<br />
    **Password:** prepnetwork2021

## Challenge

1. Create a database migration for a 'contacts' table with the following columns:

<ul>
    <li>first_name | required</li>
    <li>last_name | required</li>
    <li>phone | optional</li>
    <li>email | optional</li>
    <li>website_id | optional</li>
</ul>

2. After migrating, run the existing seeder to populate the contacts table with 50 sample contacts:

```
php artisan db:seed --class=ContactSeeder
```

3. Create the CRUD routes for contacts. Additionally, create a Contact model and a ContactController.

4. After you have seeded the contacts table, add two new methods to the contact model:

    <ol>
        <li>fullName() - Return a concatenated first and last name for the contact</li>
        <li>website() - Return a relationship to query the contact's corresponding website using website_id</li>
    </ol>

5. Build the index page for contacts and utilize the existing file: views/dashboard/contacts/index-contacts.blade.php. For the full name and website table columns, use the methods created in the previous step. Paginate the contact list with 10 contacts on each page.

    **Tip:** Eager load the contact's website to improve performance when querying contacts.

6. Create the necessary methods for CRUD functionality in the ContactController. Add the necessary form content to the files below. Both the create and edit forms should update each of the fields found in the contacts table.

    **Important:** Add the class 'ajax' to your forms to assist with error handling in step 7

<ul>
    <li>views/dashboard/contacts/modals/create-contact.blade.php</li>
    <li>views/dashboard/contacts/modals/edit-contact.blade.php</li>
</ul>

**Tip:** Utilize the following redirect method to redirect back to the index page after storing or updating a contact:

```
return response()->json(['redirect' => route('your-route')]);
```

7. Utilize Laravel's form requests to validate the incoming form data. In the validation rules, make the first_name and last_name fields required. [Form Request Documentation](https://laravel.com/docs/8.x/validation#form-request-validation)

    **Tip:** You do not need to write any logic to display the errors, an existing Javascript function will display any errors that are thrown by your validation.

8. Finalize the CRUD functionality by adding a delete method to the Delete button found at resources/views/dashboard/contacts/index-contacts.blade.php. After deleting, redirect back to the index route for contacts.

9. After completing the challenge, send your completed work to travis@prepnetwork.com

## Bonus Task (Optional)

If you have completed the steps above and would like an additional challenge, create a set of feature tests to ensure that a user can successfully index, store, and update contacts.