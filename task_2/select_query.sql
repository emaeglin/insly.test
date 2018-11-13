-- --------------------------------------------------------
-- Host:                         testdb.c9pwet9rfj2i.eu-west-2.rds.amazonaws.com
-- Server version:               5.6.41 - Source distribution
-- Server OS:                    Linux
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

SELECT
	employees.name, employees.birthdate, employees.snn, employees.current_employee, employees.email, employees.phone, employees.address,
	employees_info.lang, employees_info.introduction, employees_info.work_experience, employees_info.education
FROM employees
	JOIN employees_info ON employees.id = employees_info.employee_id
WHERE employees.email = 'emaeglin@gmail.com';