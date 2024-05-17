# Projeto feito em Laravel

### Pré-requisitos
É necessário instalar o composer:
```
https://getcomposer.org/download/
```

### Rodar
Para rodar o projeto é necessário rodar o seguinte comando para aplicar as migrações:
```
php artisan migrate
```

Após as migrações serem aplicadas, para rodar o projeto é necessário o seguinte comando:
```
php artisan serve
```

O projeto rodará no caminho:
```
http://127.0.0.1:8000/
```

## API

Endpoints disponíveis:

#### Livros

Pegar todos:
```
curl http://127.0.0.1:8000/api/books
```
Response:
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "title": "livro 2",
            "published_at": "2000-09-10",
            "authors": [
                {
                    "id": 1,
                    "created_at": "2024-05-16T22:51:07.000000Z",
                    "updated_at": "2024-05-16T22:51:07.000000Z",
                    "name": "mariana",
                    "birth_date": "1998-03-02",
                    "pivot": {
                        "book_id": 1,
                        "author_id": 1
                    }
                }
            ]
        }
    ]
}
```
---
Criar:
```
curl --location 'http://127.0.0.1:8000/api/books' \
--header 'Content-Type: application/json' \
--data '{
    "title": "livro 2",
    "published_at": "2000-09-10",
    "author_ids": [
        "1"
    ]
}'
```
Response:
```json
{
    "success": true,
    "data": {
        "id": 2,
        "title": "livro 2",
        "published_at": "2000-09-10",
        "authors": [
            {
                "id": 1,
                "created_at": "2024-05-16T22:51:07.000000Z",
                "updated_at": "2024-05-16T22:51:07.000000Z",
                "name": "mariana",
                "birth_date": "1998-03-02",
                "pivot": {
                    "book_id": 2,
                    "author_id": 1
                }
            }
        ]
    },
    "message": "Create Successful"
}
```
---
#### Autores

Pegar todos:
```
curl http://127.0.0.1:8000/api/authors
```
Response:
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "name": "sdfdsgsfghf",
            "birth_date": "1982-02-15"
        },
        {
            "id": 2,
            "name": "dsfsadfdsfasdfdsfs",
            "birth_date": "1998-03-02"
        }
    ]
}
```
---
Criar:
```
curl --location 'http://127.0.0.1:8000/api/authors' \
--header 'Content-Type: application/json' \
--data '{
    "name":"dsfsadfdsfasdfdsfs",
    "birth_date": "1998-03-02"
}'
```
Response:
```json
{
    "success": true,
    "data": {
        "id": 2,
        "name": "dsfsadfdsfasdfdsfs",
        "birth_date": "1998-03-02"
    },
    "message": "Create Successful"
}
```
---
#### Empréstimos

Pegar todos:
```
curl http://127.0.0.1:8000/api/loans
```
Response:
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "book_id": 1,
            "user_id": 1,
            "return_date": "2011-01-01",
            "loan_date": "2011-01-23",
            "book": {
                "id": 1,
                "title": "livro 2",
                "published_at": "2000-09-10"
            },
            "user": {
                "id": 1,
                "first_name": "ghfhg",
                "last_name": "gfhj",
                "email": "asas@asas.com",
                "email_verified_at": null,
                "password": "$2y$12$0shziQSNzZ9L475m78GK2.7tjDHYiZAuKND54YxtpyppyiggtIxMa",
                "remember_token": null
            }
        }
    ]
}
```
---
Criar:
```
curl --location 'http://127.0.0.1:8000/api/loans' \
--header 'Content-Type: application/json' \
--data '{
    "book_id":"2",
    "user_id": "2",
    "loan_date": "2011-01-23",
    "return_date": "2011-01-01"
}'
```
Response:
```json
{
    "success": true,
    "data": {
        "id": 2,
        "book_id": "2",
        "user_id": "2",
        "return_date": "2011-01-01",
        "loan_date": "2011-01-23",
        "book": {
            "id": "2",
            "title": null,
            "published_at": null
        },
        "user": {
            "id": "2",
            "first_name": null,
            "last_name": null,
            "email": null,
            "email_verified_at": null,
            "password": null,
            "remember_token": null
        }
    },
    "message": "Create Successful"
}
```
---
#### Usuários

Pegar todos:
```
curl http://127.0.0.1:8000/api/users
```
Response:
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "first_name": "jaqueine",
            "last_name": "ribeiro",
            "email": "asassdsada@asas.com",
            "password": "$2y$12$FWgAUp0zvfkMhq7rP5QaLepYu3sxNPE4VXk9HnviFd6D7hU4u/fui"
        }
    ]
}
```
---
Criar:
```
curl --location 'http://127.0.0.1:8000/api/users' \
--header 'Content-Type: application/json' \
--data-raw '{
    "first_name": "jaqueine",
    "last_name": "ribeiro",
    "email": "asassdsada@asas.com",
    "password": "1234"
}'
```
Response:
```json
{
    "success": true,
    "data": {
        "id": 2,
        "first_name": "jaqueine",
        "last_name": "ribeiro",
        "email": "asassdsada@asas.com",
        "password": "$2y$12$FWgAUp0zvfkMhq7rP5QaLepYu3sxNPE4VXk9HnviFd6D7hU4u/fui"
    },
    "message": "Create Successful"
}
```
