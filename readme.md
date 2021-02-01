# Codeigniter 3 - REST API

Codeigniter 3 REST API Operations

### Description
Simple REST API Operation :
- GET - All User
- GET - User by ID
- POST - Add User
- PUT - Edit User by ID
- DELETE - Remove User ID

### How to use
- Clone this Repository
- Run ``` composer update ```
- Edit Line 659 from **RestController.php** file inside **/vendor/chriskacerguis/codeigniter-restserver/src/** into
``` $http_code > 0 || $http_code = self::HTTP_OK; ```

### Resources
- Codeigniter 3.1.11
- [chriskacerguis/codeigniter-restserver](https://github.com/chriskacerguis/codeigniter-restserver)