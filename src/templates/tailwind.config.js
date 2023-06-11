/** @type {import('tailwindcss').Config} */

module.exports = {
	prefix: 'kf-',
	content: [
		'./app/Views/admin/*.php',
		'./app/Views/admin/**/*.php'
	],
	theme: {
		extend: {
			spacing: {
				px: '1px',
				0: '0',
				0.5: '2px',
				1: '4px',
				1.5: '6px',
				2: '8px',
				2.5: '10px',
				3: '12px',
				3.5: '14px',
				4: '16px',
				5: '20px',
				6: '24px'
			},
		fontSize: {
			'xs': '8px',
			'sm': '10px',
			'tiny': '14px',
			'base': '16px',
			'lg': '20px',
			'xl': '24px',
			'2xl': '32px',
			'3xl': '40px'
		}
		},
	},
	plugins: [],
}
