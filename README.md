# --- PROYECTO WEB: 'GLORY STUDIO' ---

Proyecto de página web que servirá como portfolio, blog, y tienda online para Gloria Cárcel Illán, estudiante de Bellas Artes con interés de entrar en el mundo laboral del diseño gráfico, modelado 3D para videojuegos, e ilustracion. Ya ha realizado algunos proyectos como diseñadora gráfica, y además fabrica joyas hechas a mano de resina, las cuáles quiere poder vender a través de su página.


## - Secciones

La web constará de las siguientes secciones:

* 'Index' >> Inicio de la web con un muy breve resumen de los diferentes apartados
* 'Sobre mi' >> Apartado con biografía y curriculum y los servicios que presta.
* 'Portfolio' >> Apartado con los diferentes proyectos realizados.
* 'Blog' >> Apartado en formato blog en el que se planea postear tutoriales de los diferentes programas que utiliza, o procesos de creación de los proyectos que realiza.
* 'Tienda Online' >> Apartado para la venta de los productos que realiza de forma manual.
* 'Contacto' >> Apartado con formulario de contacto y redes sociales de Gloria. **Esto podría meterse en el footer**.

    ### - Otras secciones
    Al tratarse de una tienda online, deben existir dos tipos de usuario: "usuario cliente" y "usuario administrador", existiendo
    por lo tanto dos tipos de página de perfil:

    * Perfil Cliente: Con los siguientes apartados:
        - Ver/Editar Datos de usuario.
        - Pedidos realizados.

    * Perfil Administrador: Con los siguientes apartados:
        - Ver/Editar Datos de usuario (Biografía, curriculum, servicios que presta...).
        - Crear Nuevo Post.
        - Administrar Posts (Editar/Crear/Eliminar...)
        - Administrar Categorías (Editar/Crear/Eliminar...)
        - Administrar Productos (Añadir/Eliminar/Editar...)


## Tecnologías a utilizar

- [Laravel v8.58.0](https://laravel.com/docs/8.x): Como Framework PHP de Back-End
- [Tailwindcss v2.2.7](https://tailwindcss.com/docs): Como Framework CSS.
- [Vue.js](https://vuejs.org/v2/guide/): Como Framework de JavasScrip para Front-End
- [Vanilo v2.1](https://vanilo.io/docs/2.x/what-is-vanilo): Como Framework de eCommerce para Laravel.
- [Tiptap v2.0](https://tiptap.dev/): Librería para la edición de texto enriquecido.
- [Vue 3 Datepicker](https://icehaunter.github.io/vue3-datepicker/): Librería para el selector de fecha


## Modelo de Datos

#### Modelo de Datos Generado por Vanilo

    - Address       
    - Billpayer     
    - Cart         
    - CartItem      
    - Channel       
    - Country       
    - Customer      
    - Order         
    - OrderItem     
    - Organization  
    - Permission    
    - Person        
    - Product       
    - Profile       
    - Property      
    - PropertyValue 
    - Province      
    - Role          
    - Taxon         
    - Taxonomy      
    - User     

#### Modelo de Datos Propio 

- PostCategory

| Campo | Tipo | Restricción | Notas |
|--------|------|-------------|-------|
|id | Serial | Primary Key ||
|name|varchar|not null|Nombre de la categoría|
|slug | varchar | not null | URL visible para la categoría |
| created_at | date | | Fecha de creación
| modified_at | date | | Fecha de última modificación


- Post

| Campo | Tipo | Restricción | Notas |
|--------|------|-------------|-------|
|id | Serial | Primary key ||
|name|varchar|not null | Nombre del artículo
|slug | varchar |not null | URL visible para el post
| image | varchar | | URL de la imagen
| excerpt | text | not null | Breve descripción del artículo
| content | text | not null | Contenido del artículo
| blog_category_id | Bigint | ForeignKey->Blog_Categories.id | Categoría a la que pertenece la entrada
| user_id | Bigint | ForignKey->User.id | Usuario que creó la entrada 
| publication_date | date | | Fecha de publicación. Si NULL se publica instantáneamente, si no, no aparecerá hasta la fecha indicada.
| created_at | date | | fecha de creación
| modified_at | date || fecha de última modificación


- ProjectCategory

| Campo | Tipo | Restricción | Notas |
|--------|------|-------------|-------|
|id | Serial | Primary Key ||
|name | varchar | not null | Nombre de la categoría para los proyectos
|slug |varchar | not null | URL visible para el proyecto 
| created_at | date | | fecha de creación
| modified_at | date || fecha de última modificación

- Project

| Campo | Tipo | Restricción | Notas |
|--------|------|-------------|-------|
|id | Serial | Primary Key ||
| name | varchar | not null | Nombre del proyecto
| slug | varchar | not null | URL visible para el proyecto
| image | varchar | |URL de la imagen
| description | text | not null | Descripción del proyecto.
| project_date | date | | Fecha en la que se realizó el proyecto.
| user_id | Bigint | ForeignKey->User.id | Usuario que participó en el proyecto
| project_category_id | Bigint | ForeignKey->Project_Category.id| Categoría del proyecto
| created_at | date | | fecha de creación
| modified_at | date || fecha de última modificación

- Experience

| Campo | Tipo | Restricción | Notas |
|--------|------|-------------|-------|
|id | Serial | Primary Key ||
| charge | varchar | not null | Nombre del puesto de trabajo
| company | varcahr | | Empresa para la que se trabajó
| start_date | date | not null | Fecha de inicio
| end_date | date | null | fecha de fin. Si NULL quiere decir que actualmente se realiza esa actividad.
| user_id | BigInt | ForeignKey->User.id | Usuario con dicha experiencia
| created_at | date | | fecha de creación
| modified_at | date || fecha de última modificación


- WebStatus

| Campo | Tipo | Restricción | Notas |
|--------|------|-------------|-------|
|id | Serial | Primary Key ||
| name | varchar | not null | Nombre descriptivo del estado |
| status | bool | not null | Activo o no |
| created_at | date | | fecha de creación
| modified_at | date || fecha de última modificación











