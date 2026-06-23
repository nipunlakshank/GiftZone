# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Overview

GiftZone is a gift e-commerce site (auth, product search/filter, cart) built on a hand-rolled PHP MVC framework — no Composer, no package manager, no test suite, no build step. It uses PDO + MySQL. Frontend assets are plain CSS/JS plus a vendored Bootstrap/jQuery template under `public/assets/vendor/`.

## Running locally

There is no build or test tooling. Serve over Apache with `mod_rewrite` (the routing depends on `.htaccess`):

- `public/` is the web root / front controller. The repo-root `index.php` just redirects to `public/`.
- Local config assumes the app is reachable at `http://localhost/giftzone/public` (see `ROOT` in `app/core/config.php`), i.e. the project lives under Apache's docroot as `giftzone/`.
- Create the MySQL database named `giftzone_db` (config in `app/core/config.php`). The repo contains **no schema/migrations** — tables (`users`, `products`, `categories`, `cart`, `cart_items`) must exist already; infer columns from the `$insert_columns`/`$select_columns` arrays in `app/models/`.
- `app/core/config.php` branches on `$_SERVER['SERVER_NAME']` (`localhost` vs. live). DB credentials are committed here — edit this file to point at your DB.

## Request lifecycle

1. Apache rewrites all non-file/non-dir requests to `public/index.php?url=...` (`public/.htaccess`).
2. `public/index.php` requires `app/core/init.php` and instantiates `App`.
3. `init.php` registers an autoloader that loads **model classes only** from `app/models/$class_name.php`, then requires the core files (config, functions, database, model, controller, app).
4. `App` (`app/core/app.php`) parses `url` into `[controller, method, ...params]`:
   - Segment 0 → controller class (defaults to `home`; falls back to `_404` if the controller file doesn't exist).
   - Segment 1 → method (defaults to `index`; falls back to `index` if the method doesn't exist).
   - Remaining segments are passed as positional args to the method via `call_user_func_array`.
   - `App::$page` (static) holds the current page name, read by views.
   - `validate_session()` runs on every request before dispatch.

So a route like `/shop/category/3/2` calls `Shop::category("3", "2")`.

## MVC layers

- **Controllers** (`app/controllers/`) extend `Controller`. They fetch data via models and call `$this->view("name", $data)`. Controllers are matched case-insensitively but files are `Ucfirst` (e.g. `Shop.php`). `index.php` files in `app/controllers/` and `app/views/` are stubs that print "Access Denied" to block directory listing.
- **Views** (`app/views/`) are named `name.view.php` and rendered by `Controller::view()`, which `extract()`s the data array into local variables. Shared partials live in `app/views/includes/`; admin views in `app/views/admin/`.
- **Models** (`app/models/`) extend `Model` → `Database`.

## The Model / Database base classes

`Model` (`app/core/model.php`) is a thin active-record-ish base. A subclass declares `$table`, `$insert_columns`, `$select_columns`, and optionally `$update_columns`. It builds parameterized SQL via PDO:

- `insert($data)` — filters `$data` to `$insert_columns`, runs an `insert_hook($data)` first (override to transform/sanitize, e.g. `User` hashes passwords there), returns last insert id.
- `select($data)` / `selectOne($data)` / `selectAll()` — build `WHERE col = :col && ...` queries (note: SQL `&&`). `selectOne` adds `ORDER BY id DESC LIMIT 1`.
- `update($id, $data, $update_columns)` and `delete($data)`.
- Results are fetched as **objects** (`PDO::FETCH_OBJ`) by default, so view/controller code uses `$row->name`, not `$row['name']`.

`Database` (`app/core/database.php`) opens a **new PDO connection per query** (`connect()` is called inside each method). `iud()` wraps writes in a transaction; `get()` reads.

## Conventions & gotchas

- **Magic getters via `__callStatic`**: `Auth` and `CartData` resolve `Auth::getId()`, `Auth::getEmail()`, `CartData::getTotal()`, etc. by stripping `get`/`get_` and reading from `$_SESSION`. There are no explicit getter methods — adding session keys makes new getters "just work".
- **Auth/session**: login state lives in `$_SESSION['USER_DATA']` (a row object). `Auth::authenticate()` sets it and loads the cart; `Auth::is_admin()` checks `role === 'admin'`. Sessions expire via `SESSION_LIFETIME` and are revalidated/extended by `validate_session()` on each request (`app/core/functions.php`).
- **Cart**: `CartData` is a session-backed singleton mirror of the `cart`/`cart_items` tables. Cart mutations go through static methods (`addItem`, `updateItem`, `removeItem`) which re-sync `$_SESSION['CART_DATA']` via `updateCart()`. `CartItem::getData()` joins in product name/img/price and computes totals.
- **AJAX endpoints**: `Cart::add/edit/remove` and `Session::validate/state` read the raw JSON body (`json_decode(file_get_contents("php://input"))`) and `exit(json_encode(...))`. The matching client code is in `public/assets/js/`.
- **Helpers** (`app/core/functions.php`): `redirect($link)` (prefixes `ROOT`), `message($msg)` (flash messages in `$_SESSION['msg']`), `esc($str)` (output escaping), `show($x)` (debug dump), `get_value($key)` (POST reader). Use `esc()` when echoing user data into views.
- `Shop` uses a static `$search_keyword` + the global `filter()` callback (in `functions.php`) for `array_filter`-based search; pagination is computed in `Shop::pagination()` at 12 items/page.
- **Forms** are distinguished by a hidden `form` field (`login` vs `register`); `User::validate()` switches on it. Register uses `reg_email`/`new_password`/`confirm_password` field names that `insert_hook()` maps onto the real columns.
