#!/bin/sh

rm -f DEFINITION.SQL definition.sql
touch definition.sql
dia2code -t sql -cl Dept DClases.dia; cat DEFINITION.SQL >> definition.sql
dia2code -t sql -cl Userinfo DClases.dia; cat DEFINITION.SQL >> definition.sql
dia2code -t sql -cl Checkinout DClases.dia; cat DEFINITION.SQL >> definition.sql
dia2code -t sql -cl tipo_horario DClases.dia; cat DEFINITION.SQL >> definition.sql
dia2code -t sql -cl banda DClases.dia; cat DEFINITION.SQL >> definition.sql
dia2code -t sql -cl tipo_hora DClases.dia; cat DEFINITION.SQL >> definition.sql
dia2code -t sql -cl rango_banda DClases.dia; cat DEFINITION.SQL >> definition.sql
dia2code -t sql -cl horario_personal DClases.dia; cat DEFINITION.SQL >> definition.sql
dia2code -t sql -cl feriado DClases.dia; cat DEFINITION.SQL >> definition.sql
dia2code -t sql -cl horario_excepcion DClases.dia; cat DEFINITION.SQL >> definition.sql
dia2code -t sql -cl refrescamiento DClases.dia; cat DEFINITION.SQL >> definition.sql

rm -f DEFINITION.SQL