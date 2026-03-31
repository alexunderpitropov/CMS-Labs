# Лабораторная работа №3. Разработка простой темы WordPress

**Выполнил:** Питропов Александр  
**Группа:** I2302 
 
---

## Инструкции по запуску проекта

1. Убедитесь что установлен **XAMPP** с запущенными модулями Apache и MySQL
2. Откройте папку `C:\xampp\htdocs\wp_lab2\wp-content\themes\`
3. Скопируйте папку `pitdev-theme` в эту директорию
4. Откройте браузер и перейдите по адресу `http://localhost/wp_lab2/wp-admin/`
5. Перейдите в **Внешний вид → Темы**
6. Найдите тему **PitDev** и нажмите **Активировать**
7. Откройте `http://localhost/wp_lab2/` и проверьте результат

---

## Описание лабораторной работы

Цель работы — создание собственной темы WordPress с нуля. Тема **PitDev** выполнена в стиле Формулы 1: тёмный хедер, красные акценты (`#E10600` — официальный цвет F1), современный адаптивный макет.

---

## Краткая документация к теме

### Структура файлов

```
pitdev-theme/
├── style.css        # Метаданные темы + все CSS стили
├── functions.php    # Подключение стилей, регистрация меню и сайдбаров
├── index.php        # Главный шаблон — список последних 5 записей
├── header.php       # Шапка сайта (DOCTYPE, head, навигация)
├── footer.php       # Подвал сайта (три колонки + копирайт)
├── sidebar.php      # Боковая панель (виджеты или свежие записи)
├── single.php       # Шаблон отдельного поста
├── page.php         # Шаблон страницы
├── archive.php      # Шаблон архивов (рубрики, метки, даты)
├── comments.php     # Форма и список комментариев
└── screenshot.png   # Превью темы 1200x900px
```

### Ключевые особенности реализации

**1. Подключение стилей через `wp_enqueue_style()`**

В `functions.php` стили подключаются через хук `wp_enqueue_scripts`, что является правильным WordPress-способом — не через прямой `<link>` в HTML:

```php
function pitdev_enqueue_styles() {
    wp_enqueue_style( 'pitdev-style', get_stylesheet_uri(), array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'pitdev_enqueue_styles' );
```

**2. Цикл WordPress для вывода 5 последних записей**

В `index.php` используется `WP_Query` для явного ограничения количества постов:

```php
$args = array( 'posts_per_page' => 5 );
$latest_posts = new WP_Query( $args );
while ( $latest_posts->have_posts() ) : $latest_posts->the_post();
    // вывод поста
endwhile;
wp_reset_postdata();
```

**3. Подключение общих частей шаблона**

```php
<?php get_header(); ?>   // подключает header.php
<?php get_sidebar(); ?>  // подключает sidebar.php
<?php get_footer(); ?>   // подключает footer.php
```

**4. Регистрация боковой панели**

```php
register_sidebar( array(
    'name' => 'Боковая панель',
    'id'   => 'sidebar-1',
    'before_widget' => '<div class="widget">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
) );
```

**5. Адаптивная сетка CSS Grid**

```css
.main-content-sidebar {
    display: grid;
    grid-template-columns: 1fr 320px;
    gap: 40px;
}

@media (max-width: 900px) {
    .main-content-sidebar {
        grid-template-columns: 1fr;
    }
}
```

---

## Примеры использования темы

### Главная страница
Отображает последние 5 записей в виде карточек с заголовком, мета-информацией, кратким описанием и кнопкой «Читать далее».

### Страница записи (`single.php`)
Отображает полный текст записи с навигацией между постами и блоком комментариев.

### Страница (`page.php`)
Отображает статические страницы (например, «Контакты») с поддержкой миниатюр и комментариев.

### Архив (`archive.php`)
Отображает записи по рубрике, метке, автору или дате с заголовком архива.

### Боковая панель (`sidebar.php`)
Поддерживает виджеты WordPress. Если виджеты не настроены — автоматически показывает последние записи и рубрики.

---

## Ответы на контрольные вопросы

### 1. Какие два файла являются обязательными для любой темы WordPress?

Обязательными файлами для любой темы WordPress являются **`style.css`** и **`index.php`**.

`style.css` должен содержать заголовок с метаданными темы (название, автор, версия и т.д.) в специальном формате комментария. `index.php` является главным резервным шаблоном — WordPress использует его когда не находит более специфичный шаблон.

### 2. Как подключаются общие части шаблонов (header, footer, sidebar)?

Общие части шаблонов подключаются с помощью встроенных функций WordPress:

- `get_header()` — подключает файл `header.php`
- `get_footer()` — подключает файл `footer.php`
- `get_sidebar()` — подключает файл `sidebar.php`

Эти функции также вызывают хуки `wp_head()` и `wp_footer()`, которые необходимы для корректной работы плагинов и самого WordPress.

### 3. Чем отличаются `index.php`, `single.php` и `page.php`?

- **`index.php`** — главный резервный шаблон. Используется для отображения списка записей на главной странице блога, а также как запасной вариант если нет другого подходящего шаблона.
- **`single.php`** — шаблон для отображения **одной записи** (поста) блога. Активируется когда пользователь открывает конкретную запись.
- **`page.php`** — шаблон для отображения **статических страниц** WordPress (например, «О нас», «Контакты»). Страницы не являются записями блога и имеют свой отдельный шаблон.

### 4. Зачем нужен файл `functions.php` в теме?

`functions.php` — это файл функций темы, который работает как плагин, но применяется только когда активна данная тема. В нём можно:

- Подключать CSS и JS файлы через `wp_enqueue_style()` и `wp_enqueue_scripts()`
- Регистрировать области меню через `register_nav_menus()`
- Регистрировать боковые панели через `register_sidebar()`
- Добавлять поддержку функций WordPress через `add_theme_support()`
- Определять вспомогательные функции для использования в шаблонах

---

## Список использованных источников

1. [WordPress Theme Handbook](https://developer.wordpress.org/themes/)
2. [WordPress Template Hierarchy](https://developer.wordpress.org/themes/basics/template-hierarchy/)
3. [wp_enqueue_style() — WordPress Developer](https://developer.wordpress.org/reference/functions/wp_enqueue_style/)
4. [register_sidebar() — WordPress Developer](https://developer.wordpress.org/reference/functions/register_sidebar/)
5. [The Loop — WordPress Developer](https://developer.wordpress.org/themes/basics/the-loop/)

---

## Дополнительные важные аспекты

### Иерархия шаблонов WordPress

WordPress использует систему иерархии шаблонов — при запросе страницы CMS ищет наиболее подходящий файл шаблона. Например, для записи: `single-{post-type}.php` → `single.php` → `index.php`.

### Отладка темы

В `wp-config.php` включена отладка:
```php
define('WP_DEBUG', true);
```
Это позволяет видеть PHP ошибки и предупреждения при разработке темы.

### CSS переменные (Custom Properties)

В теме используются CSS переменные для централизованного управления цветовой схемой:
```css
:root {
    --f1-red: #E10600;
    --f1-dark: #1a1a1a;
}
```
Это упрощает изменение цветовой темы в будущем.
