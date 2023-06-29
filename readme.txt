The API provides an opportunity to interact with the service of publishing records by subscription(subs). This application that has no functional interface. 

login

POST login/login.php {username},{password}				returns JWT code if success(need for actions that require authorization) 

Available users: admin, Rodion. Password for both 'qwerty'

subs

GET  subs/getAll.php {available}				get all subs (available empty) OR only avalable subs (available=1)
GET  subs/get.php {id} 						get sub by id
POST subs/create.php  {name},{cost},{publications},{jwt}	create new sub option, need admin jwt
POST subs/update.php  {id},{name},{cost},{publications}		change everything except id. Need to fill all fields
POST subs/current.php {jwt}					get current sub by jwt
POST subs/delete.php  {jwt},{id}				deactivate sub. Need admin jwt
POST subs/restore.php  {jwt},{id}				activate sub. Need admin jwt

publications

GET  publications/getAll.php 					get all publications
POST publications/create.php {title},{text},{jwt}		create publication


buy
POST buy/buy.php {sub_id},{jwt}					return PayPal button for initiate purchase of sub
GET  buy/process.php {paymentID},{token},{payerID},{sid},{uid}  after PayPal confirmation of buying and validating data make available to create publications for users
 
