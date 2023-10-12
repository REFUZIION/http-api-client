# Fuziion HttpApi Client

This PHP library provides a simple and versatile HTTP API client for interacting with APIs. It allows you to make GET and POST requests to an API, and it also includes a data handling feature for easily working with API response data.

## Installation

You can install this library using [Composer](https://getcomposer.org/):

```shell
composer require fuziion/http-api-client
```

## Usage
To use the `Fuziion\HttpApi\Client` class, follow these steps:

### Import the necessary namespace:
```php
use Fuziion\HttpApi\Client;
```
### Create a Client instance by providing your API key and API URL:
```php
$client = new Client('your-api-key', 'https://api.example.com');
```

### Make GET or POST requests to the API:

#### GET Request:
```php
$response = $client->get('/some/endpoint');
if ($response) {
    // Access API response data using magic getters
    echo $response->some_key; // Access 'some_key' in the response data
    // Or get the entire data array
    $data = $response->getData();
    print_r($data);
} else {
    // Handle the error
    echo "Error making the API GET request.";
}

```

#### POST Request:

```php
$data = [
    'key1' => 'value1',
    'key2' => 'value2',
];

$response = $client->post('/some/endpoint', $data);
if ($response) {
    // Access API response data using magic getters
    echo $response->some_key;
    // Or get the entire data array
    $data = $response->getData();
    print_r($data);
} else {
    // Handle the error
    echo "Error making the API POST request.";
}
```

Replace `'your-api-key'` and `'https://api.example.com'` with your actual API key and URL. If the API you are trying to reach does not require an bearer token then just leave this field empty.

## DataObject
The library includes a DataObject class for handling API response data with magic getters. It simplifies the process of accessing data within the API response.
```php
use Fuziion\HttpApi\Data\DataObject;

$data = new DataObject(['key1' => 'value1', 'key2' => 'value2']);
```

```php
echo $data->key1; // Access 'key1' in the data object
```

## License
This library is licensed under the MIT License. See the LICENSE file for details.
