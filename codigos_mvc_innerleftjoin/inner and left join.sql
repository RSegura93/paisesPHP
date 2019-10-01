
-- LEFT JOIN
-- no excluirá a las personas que no hayan viajado
SELECT * -- muestra 9 filas
FROM person
left join pais_visitado_x_persona pxp on person.id=pxp.id_persona
left join paises on paises.id=pxp.id_pais;

-- INNER JOIN
-- excluirá a las personas que no hayan viajado
SELECT * -- solo muestra 7 filas
FROM person
inner join pais_visitado_x_persona pxp on person.id=pxp.id_persona
inner join paises pe on pais.id=pxp.id_pais;

-- Estructura de tablas y datos
person = [ 
	{id: 1, name: "Javier"},
	{id: 2, name: "Marta"},
	{id: 3, name: "Mónica"},
	{id: 4, name: "Miriam"},
	{id: 5, name: "José"}
];

paises = [ 
	{id: 11, name: "Perú"},
	{id: 12, name: "Francia"},
	{id: 13, name: "Alemania"},
	{id: 14, name: "Venezuela"}
];

pais_visitado_x_persona = [
	{id_pais: 11, id_persona: 1},
	{id_pais: 11, id_persona: 2},
	{id_pais: 12, id_persona: 1},
	{id_pais: 12, id_persona: 2},
	{id_pais: 13, id_persona: 2},
	{id_pais: 13, id_persona: 3},
	{id_pais: 14, id_persona: 2}
];