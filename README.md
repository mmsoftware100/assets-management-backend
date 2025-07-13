# Assets Management Backend

basic assets management


## Main Modules

- [ ] region
- [ ] township
- [ ] bank type
- [ ] bank
- [ ] assets
- [ ] land



## Bash

```bash
php artisan make:model Region -mcs
php artisan make:model Township -mcs
php artisan make:model BankType -mcs
php artisan make:model Bank -mcs
php artisan make:model Asset -mcs
php artisan make:model Land -mcs


php artisan make:controller Api/V1/BankApiController
php artisan make:controller Api/V1/AssetApiController
php artisan make:controller Api/V1/LandApiController
php artisan make:controller Api/V1/MasterApiController
```

## Prompts


give migration, model and api controller

add CRUD methods in api controller with proper request validation in one page 


## 2025-07-13 api integration with next

- [ ] prepare auth endponts sign-in and me


## 2025-07-14 , data seeder for ready made 


- [ ] 4 regions ရန်ကုန် နေပြည်တော် မန်းလေး တောင်ကြီး
- [ ] 8 townships , two for each region
- [ ] one bank on each township 