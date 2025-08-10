<?php

namespace Luisinder\BlowfishLib;

/**
 * Backwards-compatible Blowfish (bcrypt) password helper.
 * Original class modernized: typed properties, password_hash()/password_verify(),
 * validation and clearer API names. Retains file autoload for BC.
 */
class BlowFish
{
	/**
	 * Cost factor (work factor) used by bcrypt. Typical range 10-14.
	 */
	private int $cost;

	/**
	 * @param int $cost Bcrypt cost (log2 rounds). 10 default. Clamped to [4,31].
	 */
	public function __construct(int $cost = 10)
	{
		$this->cost = $this->sanitizeCost($cost);
	}

	/**
	 * Hash a plain password using bcrypt.
	 */
	public function hashPassword(string $password): string
	{
		$hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => $this->cost]);
		if ($hash === false) {
			throw new RuntimeException('Failed to generate password hash.');
		}
		return $hash;
	}

	/**
	 * Verify a plain password against an existing bcrypt hash.
	 */
	public function verifyPassword(string $password, string $hash): bool
	{
		return password_verify($password, $hash);
	}

	/**
	 * Check if an existing hash should be rehashed given current cost.
	 */
	public function needsRehash(string $hash): bool
	{
		return password_needs_rehash($hash, PASSWORD_BCRYPT, ['cost' => $this->cost]);
	}

	/**
	 * Returns current cost value.
	 */
	public function getCost(): int
	{
		return $this->cost;
	}

	/**
	 * For backward compatibility with old method name crypt_blowfish().
	 * @deprecated Use hashPassword().
	 */
	public function crypt_blowfish(string $password): string
	{
		return $this->hashPassword($password);
	}

	/**
	 * For backward compatibility with old method name checkPassword().
	 * @deprecated Use verifyPassword().
	 */
	public function checkPassword(string $plain, string $hash): bool
	{
		return $this->verifyPassword($plain, $hash);
	}

	/**
	 * Internal: clamp cost into valid range and provide a sane default.
	 */
	private function sanitizeCost(int $cost): int
	{
		if ($cost < 4) return 4; // bcrypt minimum
		if ($cost > 31) return 31; // bcrypt maximum
		return $cost;
	}
}
// Backwards compatibility: allow referencing old lowercase class name
// Backwards compatibility for legacy global class names when file is included directly
if (!\class_exists('blowFish')) {
	\class_alias(BlowFish::class, 'blowFish');
}
if (!\class_exists('BlowFish')) { // PascalCase global
	\class_alias(BlowFish::class, 'BlowFish');
}

?>