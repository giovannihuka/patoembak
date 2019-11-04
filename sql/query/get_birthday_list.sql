SELECT i.full_name,i.nick_name,date_format(i.birth_date,'%d') 'tgl_ulangtahun', YEAR(CURDATE()) - YEAR(i.birth_date) 'umur'
FROM individuals i
WHERE i.status_data = "Aktif" and month(str_to_date(i.birth_date,"%Y-%m-%d")) = month(NOW())
ORDER BY date_format(i.birth_date,'%d') ASC