<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Homework</title>
		<script language="JavaScript">			
			function Vessel(name, position, capacity) 
			{
				this.name = name;
				this.position = position;
				this.capacity = capacity;
				this.freespace = capacity;
				this.occupiedspace = 0;
			};
			/*
			 * Создает экземпляр космического корабля.
			 * @name Vessel
			 * @param {String} name Название корабля.
			 * @param {Number}[] position Местоположение корабля.
			 * @param {Number} capacity Грузоподъемность корабля.
			 */
Vessel.prototype.report = function ()
 
 {
 	document.write('Корабль '+this.name+'. Местоположение: '+ this.position.toString() + '. Занято ' + this.getOccupiedSpace() + ' из ' + this.capacity + " <br>");
 /*
 * Выводит текущее состояние корабля: имя, местоположение, доступную грузоподъемность.
 * @example
 * vessel.report(); // Грузовой корабль. Местоположение: Земля. Товаров нет.
 * @example
 * vesserl.report(); // Грузовой корабль. Местоположение: 50,20. Груз: 200т.
 * @name Vessel.report
 */
 };
Vessel.prototype.getFreeSpace = function ()

{
	return this.freespace;
/*
 * Выводит количество свободного места на корабле.
 * @name Vessel.getFreeSpace
 */
};

Vessel.prototype.getOccupiedSpace = function ()
 
 {
 	return this.occupiedspace;
 	/*
 * Выводит количество занятого места на корабле.
 * @name Vessel.getOccupiedSpace
 */
 };



Vessel.prototype.flyTo = function (newPosition) 

{
	if (newPosition instanceof Planet)
	{
		this.position = newPosition.position;
	};
	if (newPosition instanceof Array)
	{
		this.position = newPosition;
	};
	/*
 * Переносит корабль в указанную точку.
 * @param {Number}[]|Planet newPosition Новое местоположение корабля.
 * @example
 * vessel.flyTo([1,1]);
 * @example
 * var earth = new Planet('Земля', [1,1]);
 * vessel.flyTo(earth);
 * @name Vessel.report
 */
};

function Planet(name, position, availableAmountOfCargo) 

{
	this.name = name;
	this.position = position;
	this.availableAmountOfCargo = availableAmountOfCargo;
	/*
 * Создает экземпляр планеты.
 * @name Planet
 * @param {String} name Название Планеты.
 * @param {Number}[] position Местоположение планеты.
 * @param {Number} availableAmountOfCargo Доступное количество груза.
 */
};


Planet.prototype.report = function () 

{
	document.write("\r\n" + 'Планета '+this.name+'. Местоположение: '+ this.position.toString() + '. Доступно груза ' + this.getAvailableAmountOfCargo() + " <br>");
/*
 * Выводит текущее состояние планеты: имя, местоположение, количество доступного груза.
 * @name Planet.report
 */
};


Planet.prototype.getAvailableAmountOfCargo = function () 

{
return this.availableAmountOfCargo;
	/*
 * Возвращает доступное количество груза планеты.
 * @name Vessel.getAvailableAmountOfCargo
 */
};


Planet.prototype.loadCargoTo = function (vessel, cargoWeight) 

{
	if (vessel.position==this.position)
	{
		this.availableAmountOfCargo -= cargoWeight;
		if (vessel.freespace >= cargoWeight)
		{
			vessel.freespace -=  cargoWeight;
			vessel.occupiedspace += cargoWeight;
		} 
	};
/*
 * Загружает на корабль заданное количество груза.
 * 
 * Перед загрузкой корабль должен приземлиться на планету.
 * @param {Vessel} vessel Загружаемый корабль.
 * @param {Number} cargoWeight Вес загружаемого груза.
 * @name Vessel.loadCargoTo
 */	
};


Planet.prototype.unloadCargoFrom = function (vessel, cargoWeight) 

{
	if (vessel.position==this.position)
	{
		if (vessel.freespace < cargoWeight)
		{
		vessel.freespace += cargoWeight;
		vessel.occupiedspace -= cargoWeight;
		this.availableAmountOfCargo += cargoWeight;
		}
	};
/*
  Выгружает с корабля заданное количество груза.
 * 
 * Перед выгрузкой корабль должен приземлиться на планету.
 * @param {Vessel} vessel Разгружаемый корабль.
 * @param {Number} cargoWeight Вес выгружаемого груза.
 * @name Vessel.unloadCargoFrom
 */
};



		</script>
	</head>
	
	<body>
		<script language="JavaScript">
			var vessel = new Vessel('Яндекс', new Array(0,0), 1000);
			var planetA = new Planet('A', [0,0], 0);
			var planetB = new Planet('B', [100, 100], 5000);

			vessel.report();// Корабль "Яндекс". Местоположение: 0,0. Занято: 0 из 1000т. 
			planetA.report();  //Планета "A". Местоположене: 0,0. Грузов нет.
			planetB.report();  //Планета "B". Местоположене: 100,100. Доступно груза: 5000т.

			vessel.flyTo(planetB);
			planetB.loadCargoTo(vessel, 1000);
			vessel.report();  //Корабль "Яндекс". Местоположение: 100,100. Занято: 1000 из 1000т.

			vessel.flyTo(planetA);
			planetA.unloadCargoFrom(vessel, 500);
			vessel.report();  //Корабль "Яндекс". Местоположение: 0,0. Занято: 500 из 1000т.
			planetA.report();  //Планета "A". Местоположение: 0,0. Доступно груза: 500т.
			planetB.report(); // Планета "B". Местоположение: 100,100. Доступно груза: 4000т.
		</script>
	</body>
</html>