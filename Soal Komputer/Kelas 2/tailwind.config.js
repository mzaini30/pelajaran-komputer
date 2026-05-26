/** @type {import('tailwindcss').Config} */
export default {
  content: ['./src/**/*.{html,js,svelte,ts}'],
  theme: {
    extend: {
      colors: {
        apple: {
          blue: '#0066cc',
          ink: '#1d1d1f',
          canvas: '#ffffff',
          parchment: '#f5f5f7',
          'tile-1': '#272729',
          'tile-2': '#2a2a2c',
          'tile-3': '#252527',
          'body-muted': '#cccccc',
          'ink-muted-80': '#333333',
          'ink-muted-48': '#7a7a7a',
          'divider-soft': '#f0f0f0',
          'hairline': '#e0e0e0',
        }
      },
      fontFamily: {
        sans: ['Inter', 'SF Pro Text', 'system-ui', 'sans-serif']
      },
      borderRadius: {
        'apple-sm': '8px',
        'apple-md': '11px',
        'apple-lg': '18px',
      }
    }
  },
  plugins: []
};
