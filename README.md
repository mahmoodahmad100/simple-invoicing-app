### Getting started:
* You do not have a `.env` file in the project root directory so copy `.env.example` and save it as `.env`

* In `.env` file update `LOG_SLACK_WEBHOOK_URL` with your slack incoming webhook to send real-time errors that occur in the system. if you don't have one you can use this one `https://hooks.slack.com/services/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` and you can checkout slack by joining from [here](https://join.slack.com/t/newworkspace-kke8575/shared_invite/zt-wompvw7a-QKR3icuaTDbWOPy_UxKFGQ)

* Open the terminal and navigate to the project directory and run `composer install`

* Generate the application key using `php artisan key:generate`

* Now you can check the invoice API (`POST` request) by using postman (the full url will be something like this: `http://localhost/simple-invoicing-app/api/v1/invoices` depands on where you cloned the project), here is an example from postman:
![API request example](api_request_example.PNG)

* You can run the tests by running `./vendor/bin/phpunit` also before running the tests you check the code coverage reports by opening `ci/codeCoverage/index.html` in the browser