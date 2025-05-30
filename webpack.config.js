const path = require('path');

module.exports = {
  entry: './assets/app.js',
  output: {
    filename: 'app.js',
    path: path.resolve(__dirname, 'public/build'),
  },
  module: {
    rules: [
      {
        test: /\.css$/,
        use: ['style-loader', 'css-loader'],
      },
    ],
  },
};