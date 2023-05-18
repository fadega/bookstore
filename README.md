**Step 4 -**

To have the starter data populated so that you can easily test the web app features, I have included all the tables that have sample data in them in a file named *databasetables.sql*. The file is located in the *public* folder. Please import this file to either *MySQL Work Bench* or *XAMPP's PhpMyAdmin*. The process of importing the databasetables.sql file is the same in both admin consoles, but here steps on how to import the sql file to MySQL Work Bench.

- Open MySQL Work bench and sign in
- Open the "bookstore" schema/database that you created
- From the top menu, click the "Server" menu item
- Click the "Data Import" from the menu that opens
- Select the radio button that says *import from self-contained file* and select the sql file (databasetables.sql) from the public folder of the project.

**Step 5 -**

To test the paypal payment integration, you need to create paypal sandbox accounts for Merchant/seller and buyer. Get the client id from the sandbox and open checkout.php under app\views\store\checkout.php and replace the client_id in line 110.
 
Please replace your payment integration client id 
"https://www.paypal.com/sdk/js?client-id=XXXXXXXXXX&disable-funding=credit,card"



That is all. There is default *admin* user with username as admin and password as *Test123*.

You can now access the backend of the website and check the features including adding, updating, and deleting authors, categories, publishers, and books.


