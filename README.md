# PruebaPractica

Esta prueba práctica tiene como finalidad evaluar cómo resuleves los siguientes problemas. Además se considerará el tiempo que demores en terminar.

Este es un proyecto Laravel 5.7 con Vue.js como librería Front-End.

Lee muy bien estas instrucciones antes de empezar. Solo podrás hacer preguntas antes de comenzar.

## Instrucciones

Tienes máximo 60 minutos para trabajar en los siguientes problemas. Puedes utilizar cualquier recurso que quieras. Puedes buscar en google pero no puedes llamar ni escribirle a nadie, debes resolver esto con tus propios medios.

### Problemas de Instalación

1. Debes clonar este repositorio en el computador que estás utilizando. No importa donde.
2. Debes crear un **Branch** con tu nombre y apellido con el formato **UpperCamelCase**
3. Debes instalar las dependencias que el proyecto necesita para funcionar
4. Debes arrancar el servidor web con **php artisan serve**
5. Debes compilar los recursos Javascript y SCSS con **npm run watch**

### Problemas de configuración

1. Los diferentes navegadores web tiene distintos estilos por defecto. Queremos estandarizar estos estilos. Instala normalize.css
2. El componente **App.vue** está vacio. Configura app.js con **Vue-Router** y crea una ruta llamada "Home" que renderice el componente **Home** para la ruta **"/"** dentro del componente **App**

### Desafío Principal

- El componente **Home** está utilizando un componente llamado **Calendario**.

1. Registra el componente **Calendario** dentro del componente **Home** para que se pueda renderizar.

- Desarrolla el componente **Calendario**:

1. Utiliza **Axios** para realizar un **POST** a una ruta que se llame **/api/getDias** que ejecute un método llamado **getDias** en un controlador llamado **CalendarioController**. Este método debe aceptar como parámetros un mes y un año.
2. El método debe devolver todos los días del mes que se solicitó en el **POST** o en su defecto el mes actual.
3. Cada vez que el componente **Calendario** se construya debe obtener los días del mes actual utilizando esta API.
4. Con los días obtenidos debes construir un calendario de 7 columnas, de lunes a domingo. Los días que no pertecen al mes no se deben mostrar.
5. Los días deben poder seleccionarse. El usuario debe poder ver gráficamente que seleccionó un día.
6. El usuario debe poder avanzar y retroceder en los meses de forma infinita.
7. Cuando se selecciona un día, se debe agregar la fecha completa a un Array llamado **fechasSeleccionadas**
8. La lista con fechas seleccionadas se debe mostrar debajo del calendario y **NO** dentro del componente calendario. TIP: El Array **fechasSeleccionadas** está definido en el componente **Home**.
9. Al final del componente **Home** crea un botón que guarde el listado de fecha seleccionadas en un archivo **.json** en la carpeta **storage/app**

## Término

Cuando estés listo o se haya terminado el tiempo, debes hacer un push con el trabajo realizado.

## Éxito
