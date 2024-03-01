# Link Shortener

Requirements: You need to have docker installed (If you do not use docker, you must have at least PHP 8.1.3 and composer installed)

Download the project to a directory and open it in the terminal

Execute the command -

<pre> docker compose up -d --build</pre>

Enter the docker container using the command -

<pre>$ docker exec -it linkShortener_app /bin/bash</pre>

Execute the commands in turn -

<pre>
<span>$ composer update</span>
<span>$ chmod -R 775 storage</span>
<span>$ chmod -R ugo+rw storage</span>
</pre>

Rename the file .env.example to .env and connect to the database
<pre>
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=linkShortener_db
DB_USERNAME=root
DB_PASSWORD=root
</pre>


Implement the logic:

namespace App\Http\Controllers\Api\V1;
class ShortenUrlController 

namespace App\Services;
interface ShortCodeGeneratorInterface
class ShortenUrlService


How to use:
You will need Postman or something else to send POST

<pre>
URL
    POST /api/shorten
    
Example Request
    {
        "url": "https://example.com/very/long/url"
    }
    
Example Response
    {
        "shortened_url": "http://localhost/abc123"
    }
</pre>

this can be entered in your bowser
<pre>
URL
    GET /api/{code}
    
Example Request
    GET /api/abc123
    
Redirect:
Redirects to the original URL associated with the code abc123.
</pre>


To check the counter, use the bruiser in incognito mode










