# laravel-dev-test
How to run the project

1. you can use laravel sail to run the project. Run command "sail up -d" otherwise
2. Then run commands "npm install" and "npm run buid"

#Packages used
1. Cashier with stripe SDK.
2. Spatie for roles managment

There are following things that I couldn't implement since I had only 16 hours
1. we haven't written unit tests.
2. We have implemented simple email events but we have not used messaging queues to scale email sending.
3. For Payments we have implemented transaction to minimize inconsistency.
4. I havent focused on UI particularly
5. I havent catered the race conditions when making payment although i had tha in mind. race conditons happen when two users want to buy same product at a time and the quantity of that product is only one.
6. we have implemented a refund option if user want to refund

# There are thee users in the seeder
1. email = 'admin@admin.com' password = '123456'
2. email = 'b2b@b2b.com' password = '123456'
3. email = b2c@b2c.com' password = '123456'

Final thoughts
There were many improvements that i could have done in terms of scalability and performance. Like scaling events using messaging queues and securing urls parameters using encryption but that would have required a lot of time.

