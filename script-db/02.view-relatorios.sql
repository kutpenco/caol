-- USE `formula-ouro`;

DROP VIEW IF EXISTS view_relatorios;

 CREATE VIEW view_relatorios AS
    select 	
	u.co_usuario,
	u.no_usuario,
	c.co_cliente,
	c.no_razao,
	
	month(f.data_emissao) mes_emissao,
	year(f.data_emissao) ano_emissao,
	
	concat(monthname(f.data_emissao), ' ', year(f.data_emissao)) periodo,

	sum(f.valor * (1 - f.total_imp_inc/100)) receita_liquida,
	
	-s.brut_salario custo_fixo,
	
	-(sum(f.valor * (1 - f.total_imp_inc/100) * (f.comissao_cn / 100) ) ) comissao,
	
	sum(f.valor * (1 - f.total_imp_inc/100)) 
	- s.brut_salario
	-(sum(f.valor * (1 - f.total_imp_inc/100) * (f.comissao_cn / 100) ) ) lucro
	
from cao_fatura f
inner join cao_os o on o.co_os = f.co_os
inner join cao_usuario u on u.co_usuario = o.co_usuario
inner join cao_salario s on s.co_usuario = u.co_usuario
inner join cao_cliente c on c.co_cliente = f.co_cliente
group by u.co_usuario, year(f.data_emissao), month(f.data_emissao);

-- select * from cao_salario s;
