## About EAMS

EAMS is a web application used for HRM of employees with robust authentication and access manangement system made in lastest Laravel 7.25 Framework and MySQL.

- [Simple, fast routing engine of laravel is used](https://laravel.com/docs/routing).

- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent) is used for database queries.
- Efficient usage of laravel [relationships](https://laravel.com/docs/7.x/eloquent-relationships).

- [Gates](https://laravel.com/docs/7.x/authorization) used  for authorizations.
- [Session](https://laravel.com/docs/7.x/session) used for remembering the logged in user.
- Fully responsive website across all devices and screen sizes.

EAMS is fast and easy to use and can be customized easily according to client project

## Usage

It has two sides employee and admin side.
**Employee** has:
- Attendance module
	- Register attendance
		- While recording user public IPv4 and current location in address format using reverse geocoding.
	- List attendances
- Leaves
	- Apply for leaves
	- Review leave status applied
- Expenses
	- Claim for an expense
	- Review expenses claimed
- Self
	- View Holiday List
	- Print salary slip
- Profile
	- Set profile information
	- Change password

**Admin** has:
- Employee module
	- Add employee
	- View employees
	- Monitor employee attendance
- Authorizate
	- Leaves applied
	- Expenses claimed
- Holidays
	- Add, edit, remove holidays according to company regulations

## Themes, plugins, packages used for developement
Following are the assets used for this project
-	[AdminLTE](https://adminlte.io/) a bootstrap and jquery based admin dashboard theme
-	[DataRangePicker](https://www.daterangepicker.com/) for date pickers
-	[DataTables](https://datatables.net/) for responsive table
-	[Intervention/Image](http://image.intervention.io/getting_started/installation) package in laravel for image upload optimisaton
-	[HTML Geolocation API](https://www.w3schools.com/html/html5_geolocation.asp) which works only on SSL, for using make sure your domain is SSL certified.
-	[Nominatim](https://nominatim.org/) an open source geocoding API for reverse geocoding.
