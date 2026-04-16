<?php
namespace qnap;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'not here' );
}

class QNAP_Recursive_Directory_Iterator extends \RecursiveDirectoryIterator {

	public function __construct( $path ) {
		parent::__construct( $path );

		// Skip current and parent directory
		$this->skipdots();
	}

	public function rewind(): void {
		parent::rewind();

		// Skip current and parent directory
		$this->skipdots();
	}

	public function next(): void {
		parent::next();

		// Skip current and parent directory
		$this->skipdots();
	}

	/**
	 * Returns whether current entry is a directory and not '.' or '..'
	 *
	 * Explicitly set allow links flag, because RecursiveDirectoryIterator::FOLLOW_SYMLINKS
	 * is not supported by <= PHP 5.3.0
	 *
	 * @return bool
	 */
	public function hasChildren( bool $allow_links = true ): bool {
		return parent::hasChildren( $allow_links );
	}

	protected function skipdots() {
		while ( $this->isDot() ) {
			parent::next();
		}
	}
}
