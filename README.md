[![](https://scdn.rapidapi.com/RapidAPI_banner.png)](https://rapidapi.com/package/ApiLeapAPI/functions?utm_source=RapidAPIGitHub_ApiLeapFunctions&utm_medium=button&utm_content=RapidAPI_GitHub)


# ApiLeap Package
ApiLeap is an easy to use API that can capture near pixel perfect screenshots of web pages. It relies on the Chrome rendering engine to ensure fast and accurate rendering. As a result, modern HTML, CSS, and JS features are fully supported.

* Domain: [apileap.com](https://apileap.com)
* Credentials: accessKey

## How to get credentials: 
1. Sign in [apileap.com](https://apileap.com).
2. Navigate to Dashboard -> Access Key.
3. Copy Your Access Key.
 
## ApiLeap.getImageFromUrl
Get snapshot of the specified url

| Field    | Type       | Description
|----------|------------|----------
| accessKey| credentials| Your personal access key to use the API.
| url      | String     | The URL of the website you want to request a snapshot from.
| ttl      | Number     | The number of seconds the screenshot should be kept in cache. When a screenshot is served from cache, the API call doesn't count in your monthly credit.
| fresh    | Select     | Return a fresh new screenshot instead of the eventually cached one.
| fullPage | Select     | Set this to true if you want to capture the full height of the target website.
| width    | Number     | Width of the viewport to use.
| height   | Number     | Height of the viewport to use. This will be ignored if fullPage is set to true.
| delay    | Number     | Delay, after the pageload event is fired, to wait before taking the screenshot. From 0 to 10 seconds. Most websites are fully loaded after the pageload event so this parameter is not needed most of the time.
| format   | Select     | The format of the returned screenshot. One of ```jpeg``` and ```png```.
| css      | String     | An additional CSS string to be injected into the page before capturing.

## ApiLeap.getImageFromHtml
Get snapshot of the specified html

| Field    | Type       | Description
|----------|------------|----------
| accessKey| credentials| Your personal access key to use the API.
| html     | String     | The HTML you want to make a snapshot of.
| ttl      | Number     | The number of seconds the screenshot should be kept in cache. When a screenshot is served from cache, the API call doesn't count in your monthly credit.
| fresh    | Select     | Return a fresh new screenshot instead of the eventually cached one.
| fullPage | Select     | Set this to true if you want to capture the full height of the target website.
| width    | Number     | Width of the viewport to use.
| height   | Number     | Height of the viewport to use. This will be ignored if fullPage is set to true.
| delay    | Number     | Delay, after the pageload event is fired, to wait before taking the screenshot. From 0 to 10 seconds. Most websites are fully loaded after the pageload event so this parameter is not needed most of the time.
| format   | Select     | The format of the returned screenshot. One of ```jpeg``` and ```png```.
| css      | String     | An additional CSS string to be injected into the page before capturing.

