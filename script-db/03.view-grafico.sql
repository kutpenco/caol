-- USE `formula-ouro`;

DROP VIEW IF EXISTS view_grafico;

 CREATE VIEW view_grafico AS
    select 	
	u.co_usuario,
	u.no_usuario,
	c.co_cliente,
	c.no_razao,
		
	sum(f.valor * (1 - f.total_imp_inc/100)) receita_liquida

	
from cao_fatura f
inner join cao_os o on o.co_os = f.co_os
inner join cao_usuario u on u.co_usuario = o.co_usuario
inner join cao_salario s on s.co_usuario = u.co_usuario
inner join cao_cliente c on c.co_cliente = f.co_cliente
group by u.co_usuario;

-- select * from cao_salario s;
