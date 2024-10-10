## Prerequisites

To run this project, ensure you have the following installed:

- Composer version >= 2.4.1
- PHP version >= 8.2
- MySQL Database

## Installation Process

Follow these steps to get your application up and running:

1. **Navigate to the root directory of the project.**
2. **Run the following command to install or update the dependencies:**
   ```bash
   composer install/update
   ```
   ```bash
   cp .env .env.example
   ```

3. **Set Up Database Credentials**  
   Open the `.env` file and add your data base credentials, including:
   - DB_HOST
   - DB_PORT
   - DB_DATABASE
   - DB_USERNAME
   - DB_PASSWORD

4. **Run Migrations and Seed the Database**  
   In the root directory of your project, run the following command to migrate the database and seed it with initial data:
   ```bash
   php artisan migrate --seed
   ```
5. **Configure Mail Credentials**  
   Open the `.env` file and add your mail credentials, including:
   - Mailer
   - Host
   - Port
   - Username
   - Password
   - Mail encryption (e.g., `tls` or `ssl`)
   - MAIL_FROM_ADDRESS
   - MAIL_FROM_NAME
   - and set QUEUE_CONNECTION=database
2. **Schedule Mail Notifications**  
   In the root directory of your project, run the following command to schedule mail notifications:
   ```bash
   php artisan schedule:run
    ```
   ```bash
   php artisan queue:work
    ```
### Note
- The mail scheduler is set to run at **9 PM** every day. If you want to change the scheduled time, navigate to `App/Commands/Kernel.php` and update the desired schedule time.
- To change the mail template, go to `resources/mail.blade.php` and make your desired modifications.
- To send SMS notifications, first, you need to install SMS API packages in your Laravel application. After that, you can easily incorporate the SMS sending functionality by adding the appropriate SMS sending method within the sendNotification method located in the `App/Jobs/ScheduleJob.php` file. This will allow your application to send SMS notifications seamlessly as part of its scheduled job processes and restart the queue
```bash
   php artisan queue:restart
```
```bash
   php artisan queue:work
```
