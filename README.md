# Code Challenge 2025

## Bases

- Docker
- Docker Compose
- Symfony 7.2
- PostgreSQL
- PHP 8.2
- TailwindCSS
- Twig
- Debug
- PHPUnit
- Doctrine

## Initial setup

```bash

# Estimated build time 140s
docker compose up -d
```

## Setup your OpenAI API key IF needed

in `.env` file or `.env.local` file

```bash

# Replace me
OPENAI_API_KEY=sk-proj-replace-me
```

## Open the browser

```bash

# Open the browser
open http://localhost:42424

OR

open http://172.21.42.101
```

## Shortcut commands

```bash

# Run symfony console
./console   # for docker compose exec symfony-dev php bin/console
./symfony   # for docker compose exec symfony-dev symfony
./phpunit   # for docker compose exec symfony-dev php bin/phpunit
./composer  # for docker compose exec symfony-dev composer
```

### cURL examples

```bash

OPENAI_API_KEY="sk-proj-xyz"

curl -vva https://api.openai.com/v1/files \
    -H "Authorization: Bearer $OPENAI_API_KEY" \
    -F purpose="user_data" \
    -F file=@/replace/me/code-challenge/tests/Service/data/01_dpe.pdf
```

### Response

```json
{
  "object": "file",
  "id": "file-McaJVr94zD4DEyeNpmbRQ3",
  "purpose": "user_data",
  "filename": "01_dpe.pdf",
  "bytes": 91104,
  "created_at": 1746801775,
  "expires_at": null,
  "status": "processed",
  "status_details": null
}
```

### Prompt example using the file

```bash

OPENAI_API_KEY="sk-proj-xyz"

curl -vva "https://api.openai.com/v1/responses" \
    -H "Content-Type: application/json" \
    -H "Authorization: Bearer $OPENAI_API_KEY" \
    -d '{
        "model": "gpt-4.1",
        "input": [
            {
                "role": "user",
                "content": [
                    {
                        "type": "input_image",
                        "file_id": "file-SPaGv6njDh6sgy5KSFvov4"
                    },
                    {
                        "type": "input_text",
                        "text": "Extract valuable information from the input file with vision."
                    }
                ]
            }
        ]
    }'
```