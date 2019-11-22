# Clever Problem Demo

## Running Code

Just do the following:

  - Copy `.env.example` to `.env` and update the appropriate configs
  - `$ docker-compose up -d`
  - `$ docker exec -it clever-demo php artisan sync:schools {oauth_token} {clever_district_id} [--stdout]`
  - `$ docker-compose down`

## Notes

  - This may log PII in logs/lumen.log upon reaching an error, please handle appropriately!