module.exports = {
	extends: 'plugin:@wordpress/eslint-plugin/recommended',
	root: true,
	env: {
		browser: true,
		node: true,
		es6: true,
	},
	globals: {
		jQuery: 'readonly',
		wp: 'readonly',
	},
	ignorePatterns: [
		'**/build/*',
		'**/node_modules/*',
		'**/vendor/*',
		'**/tests/*',
	],
	rules: {
		'@wordpress/dependency-group': 'off',
		'@wordpress/i18n-text-domain': [
			'error',
			{
				allowedTextDomain: 'hook-test',
			},
		],
	},
};
