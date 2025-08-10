# blowfish-lib

Simple helper library for hashing and verifying passwords using the Blowfish (bcrypt) algorithm in PHP.

## ✨ Features

- Secure password hashing via `password_hash()` (bcrypt)
- Password verification helper
- Configurable cost factor
- Backwards-compatible method names (`crypt_blowfish`, `checkPassword`) retained

## 📦 Installation

Via Composer (recommended):

```bash
composer require luisinder/blowfish-lib
```

Or clone/download and include the file manually:

```php
require_once __DIR__ . '/src/blowFish.php';
```

## ✅ Requirements

- PHP >= 7.4

## 🚀 Usage

```php
require_once __DIR__ . '/vendor/autoload.php';

$bf = new BlowFish(12); // cost factor 12

$hash = $bf->hashPassword('My$ecretP@ss');

if ($bf->verifyPassword('My$ecretP@ss', $hash)) {
	echo "Password valid"; 
} else {
	echo "Invalid password";
}
```

### Backwards Compatibility

Older code using:

```php
$bf->crypt_blowfish($password);
$bf->checkPassword($plain, $hash);
```

…will still function, but you should migrate to:

```php
$bf->hashPassword($password);
$bf->verifyPassword($plain, $hash);
```

An internal `class_alias` keeps the legacy lowercase `blowFish` class name available.

### Rehashing Strategy

You can detect when to upgrade stored hashes to a higher cost:

```php
$bf = new BlowFish(10);
$hash = $bf->hashPassword('secret');

// Later increase cost
$bfStronger = new BlowFish(12);
if ($bfStronger->needsRehash($hash)) {
	$hash = $bfStronger->hashPassword('secret');
}
```

## ⚙️ Cost Factor Guidance

Typical values: 10–14. Higher = more secure but slower. Benchmark in your environment aiming for ~100ms or less per hash for interactive logins.

## 🔒 Security Notes

- Do NOT store plain passwords.
- Always use `password_verify()` (wrapped by `verifyPassword`).
- Rotate the cost upwards over time; you can rehash existing hashes with `password_needs_rehash()` externally if desired (not included to keep this helper minimal).

## 📄 License

MIT. See [LICENSE](LICENSE).

## 🧾 Changelog

See [CHANGELOG.md](CHANGELOG.md) for notable changes.

## 🤝 Contributing

Issues and pull requests are welcome. Please include a clear description and if possible a test snippet to reproduce or validate the change.

## 🧪 Example Script

Run the included example after install:

```bash
composer run example
```

## 🧪 Tests

Install dev dependencies and run PHPUnit:

```bash
composer install
composer test
```

## 🛠 Continuous Integration

GitHub Actions workflow runs the test suite on PHP 7.4–8.3. See `.github/workflows/ci.yml`.

## Author

Luis Cajigas

---

Enjoy and stay secure!