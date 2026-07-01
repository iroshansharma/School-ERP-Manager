# Bug Fixing Challenge

## Objective

The following code was provided in the assignment.

```php
global $wpdb;

$id = $_GET['id'];

$result = $wpdb->get_results(
    'SELECT * FROM wp_students WHERE id = $id'
);

echo $result[0]->name;
```

The code contains several security, performance, and coding standard issues.

---

# Fixed Code

```php
global $wpdb;

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$result = $wpdb->get_row(
    $wpdb->prepare(
        "SELECT * FROM {$wpdb->prefix}students WHERE id = %d",
        $id
    )
);

if ($result) {
    echo esc_html($result->name);
} else {
    echo "Student not found.";
}
```

---

# Issues Found & Explanation

## 1. Unsanitized User Input

### Original Code

```php
$id = $_GET['id'];
```

### Issue

The value is taken directly from the URL without any validation or sanitization.

An attacker can modify the URL and send unexpected values.

Example:

```
?id=abc
?id=<script>alert(1)</script>
?id=1 OR 1=1
```

Using raw user input is considered insecure.

### Solution

```php
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
```

`intval()` converts the value into an integer, preventing invalid input.

---

## 2. SQL Injection Vulnerability

### Original Code

```php
$result = $wpdb->get_results(
    'SELECT * FROM wp_students WHERE id = $id'
);
```

### Issue

The SQL query is not prepared.

If user input is inserted directly into SQL, attackers may manipulate the query and access or modify database records.

This is known as **SQL Injection**.

### Solution

```php
$result = $wpdb->get_row(
    $wpdb->prepare(
        "SELECT * FROM {$wpdb->prefix}students WHERE id = %d",
        $id
    )
);
```

`$wpdb->prepare()` safely inserts user input into SQL queries.

---

## 3. Hardcoded Table Name

### Original Code

```php
wp_students
```

### Issue

The table name is hardcoded.

Not every WordPress installation uses the `wp_` prefix.

Examples:

```
abc_students
school_students
erp_students
```

Hardcoding the table name reduces portability.

### Solution

```php
{$wpdb->prefix}students
```

Using `$wpdb->prefix` makes the code compatible with every WordPress installation.

---

## 4. Wrong Database Function

### Original Code

```php
get_results()
```

### Issue

`get_results()` returns multiple rows.

Since only one student is being searched by ID, returning multiple rows is unnecessary.

### Solution

```php
get_row()
```

`get_row()` is faster and more appropriate when only one record is expected.

---

## 5. Missing Validation

### Original Code

```php
echo $result[0]->name;
```

### Issue

If no record exists, `$result[0]` does not exist.

This can produce PHP warnings or fatal errors.

Examples:

- Undefined offset
- Trying to access property of non-object

### Solution

```php
if ($result) {

}
```

Always verify that data exists before using it.

---

## 6. Output Not Escaped

### Original Code

```php
echo $result->name;
```

### Issue

Database values should never be printed directly.

If malicious HTML or JavaScript is stored in the database, it may execute in the browser.

This is called a **Cross-Site Scripting (XSS)** vulnerability.

### Solution

```php
echo esc_html($result->name);
```

`esc_html()` safely escapes output before displaying it.

---

## 7. Missing Error Handling

### Original Code

```php
echo $result[0]->name;
```

### Issue

No message is shown if the student does not exist.

The user only sees an error.

### Solution

```php
if ($result) {

    echo esc_html($result->name);

} else {

    echo "Student not found.";

}
```

This improves user experience and prevents PHP warnings.

---

# Summary of Fixes

| Issue | Status |
|--------|--------|
| Unsanitized User Input | Fixed |
| SQL Injection | Fixed |
| Hardcoded Table Name | Fixed |
| Wrong Database Function | Fixed |
| Missing Validation | Fixed |
| Output Escaping | Fixed |
| Error Handling | Fixed |

---

# WordPress Best Practices Used

- Input Sanitization (`intval()`)
- Prepared SQL Queries (`$wpdb->prepare()`)
- Dynamic Table Prefix (`$wpdb->prefix`)
- Output Escaping (`esc_html()`)
- Error Handling
- Secure Database Access
- WordPress Coding Standards

---

# Conclusion

The original code was vulnerable to SQL Injection, Cross-Site Scripting (XSS), missing validation, and poor coding practices.

The updated version follows WordPress Coding Standards by sanitizing user input, using prepared SQL queries, escaping output, validating database results, and handling errors safely. These improvements make the code more secure, reliable, maintainable, and compatible with different WordPress installations.