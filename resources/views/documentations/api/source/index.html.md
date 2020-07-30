---
title: API Reference

language_tabs: # must be one of https://git.io/vQNgJ
  - shell
  - ruby
  - python
  - javascript

toc_footers:
  - <a href='#'>Sign Up for a Developer Key</a>
  - <a href='https://github.com/slatedocs/slate'>Documentation Powered by Slate</a>

includes:
  - errors

search: true

code_clipboard: true
---

# Introduction

Welcome to the SPPAY API! You can use our API to access SPPAY API endpoints, which can get information in our database.

We have language bindings in Shell, Ruby, Python, and JavaScript! You can view code examples in the dark area to the right, and you can switch the programming language of the examples with the tabs in the top right.

# Authentication

> To authorize, use this code:

```ruby
require 'kittn'

api = Kittn::APIClient.authorize!('meowmeowmeow')
```

```python
import kittn

api = kittn.authorize('meowmeowmeow')
```

```shell
# With shell, you can just pass the correct header with each request
curl "${BASE_URL}/oauth/token" \
  -X POST \
  -H "Accept: application/json" \
  -d '{"grant_type":"password", "client_id":"<YOUR_CLIENT_ID>", "client_secret":"<YOUR_CLIENT_SECRET", "username":"julio.rahman@gmail.com","password":"12345678"}'
```

```javascript
const kittn = require('kittn');

let api = kittn.authorize('meowmeowmeow');
```

<!-- > Make sure to replace `meowmeowmeow` with your API key. -->

the SPPAY API uses API keys to allow access to the API. You can register your client application with `php artisan passport:client --password` command. 

the SPPAY API expects for the API key to be included in all API requests to the server in a header that looks like the following:

`Authorization: Bearer {YOUR_TOKEN}`

<aside class="notice">
You must replace <code>{YOUR_TOKEN}</code> with your API key.
</aside>

# File System

## Get All Files

```ruby
require 'kittn'

api = Kittn::APIClient.authorize!('meowmeowmeow')
api.kittens.get
```

```python
import kittn

api = kittn.authorize('meowmeowmeow')
api.kittens.get()
```

```shell
curl "${BASE_URL}/api/file-management/files"
  -H "Authorization: Bearer ${YOUR_BEARER_TOKEN}"
  -x GET
```

```javascript
const kittn = require('kittn');

let api = kittn.authorize('meowmeowmeow');
let kittens = api.kittens.get();
```

> The above command returns JSON structured like this:

```json
{
    "success": "OK",
    "results": [
        {
            "id": "17b8ea10-d221-11ea-a811-405bd85ee299",
            "name": "Private Files",
            "file_parent_id": "6cb5dde6-d1ba-11ea-93ed-405bd85ee299",
            "size": null,
            "is_directory": true,
            "path": "/root_files/Private Files",
            "permission": "777",
            "owner_id": 1,
            "created_at": "2020-07-30T04:56:56.000000Z",
            "updated_at": "2020-07-30T04:56:56.000000Z"
        }, ...
    ]
}
```

This endpoint retrieves all files from specified directory/folder. if there's
no directory specified, will retrieves root directory.

### HTTP Request

`GET {BASE_URL}/api/file-management/files`

to retrieve files from specified directory:

`GET {BASE_URL}/api/file-management/files/<ID>`


### Query Parameters

Parameter | Default | type | Description
--------- | ------- | ---- |-----------
sort_key | is_directory, created_at | string | available sort key `name`, `size`, `is_directory`, `owner_id`, `permission`,`created_at`, `updated_at`
sort_order | asc, desc| string | If set to false, the result will include kittens that have already been adopted.

<aside class="success">
Remember - these routes are protected by OAuth2. thus, you must assign 
<br><code>Authorization: Bearer {YOUR_TOKEN}`</code> every time you make a request.
</aside>

## Store a File

```ruby
require 'kittn'

api = Kittn::APIClient.authorize!('meowmeowmeow')
api.kittens.get(2)
```

```python
import kittn

api = kittn.authorize('meowmeowmeow')
api.kittens.get(2)
```

```shell
curl "{$BASE_URL}/api/file-management/files"
  -H "Authorization: Bearer ${YOUR_BEARER_TOKEN}"
  -d '{"is_directory":"true","name":"New File"}'
```

```javascript
const kittn = require('kittn');

let api = kittn.authorize('meowmeowmeow');
let max = api.kittens.get(2);
```

> The above command returns JSON structured like this:

```json
{
    "success": "OK",
    "result": {
        "permission": "777",
        "is_directory": true,
        "name": "New File",
        "file_parent_id": "6cb5dde6-d1ba-11ea-93ed-405bd85ee299",
        "owner_id": 1,
        "path": "/root_files/New File",
        "updated_at": "2020-07-30T05:03:36.000000Z",
        "created_at": "2020-07-30T05:03:36.000000Z",
        "file": null
    }
}
```

This endpoint stores a file to the physical & virtual file system.


### HTTP Request

`POST {BASE_URL}/api/file-management/files`

### Body Parameters

Parameter | Description
--------- | -----------
is_directory | to specify whether the stored file is a directory or not
permission | to set permission of the file
file_parent_id | if the is file inside directory, use this parameter to specify the directory's id
owner_id | to specify the owner of the file

<aside class="warning">A non-directory file cannot be a parent, consider to not assigning non-directory as parent, it will break the logic and the system. </aside> 
<!-- <code>&lt;code&gt;</code> blocks to denote code.</aside> -->

<!-- ## Delete a Specific Kitten

```ruby
require 'kittn'

api = Kittn::APIClient.authorize!('meowmeowmeow')
api.kittens.delete(2)
```

```python
import kittn

api = kittn.authorize('meowmeowmeow')
api.kittens.delete(2)
```

```shell
curl "http://example.com/api/kittens/2"
  -X DELETE
  -H "Authorization: meowmeowmeow"
```

```javascript
const kittn = require('kittn');

let api = kittn.authorize('meowmeowmeow');
let max = api.kittens.delete(2);
```

> The above command returns JSON structured like this:

```json
{
  "id": 2,
  "deleted" : ":("
}
```

This endpoint deletes a specific kitten.

### HTTP Request

`DELETE http://example.com/kittens/<ID>`

### URL Parameters

Parameter | Description
--------- | -----------
ID | The ID of the kitten to delete
 -->
