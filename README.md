** ADAM API PROJECT **

** Project Description **
Create and make available a custom endpoint "http://localhost/wordpress/endpoint/table". When a visitor navigates to that endpoint, the plugin send an HTTP request to a REST API endpoint. The API is available at https://jsonplaceholder.typicode.com/ and the endpoint to call is /users.The plugin plugin parses the JSON response and uses it to build and display an HTML table. Each row in the HTML table shows the details for a user(id, name, username and email). When any of the fields are clicked, it shows more information about the user in a modal window. In that process, the plugin makes a second API request to the user - details endpoint. These details fetching requests are asynchronous, and the user details show without reloading the page. The HTML table is responsive using UIKIT and Bootstrap.

** Installation **
The plugin files can be upload to /wp-content/plugins/adam-end-point directory, or can be installed via cloning the repository and running composer update.

** Plugin Usage **
The plugin can be used by navigating to the available custom endpoint on the WordPress site "/endpoint/table". 

** License **
The license is GNU General Public License v3.0.