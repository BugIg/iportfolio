var
  shell = require('shelljs'),
  path = require('path')

// shell.rm('-rf', path.resolve(__dirname, '../dist/*'))
// shell.rm('-rf', path.resolve(__dirname, '../dist/.*'))
shell.rm('-rf', path.resolve(__dirname, '../../public/fonts/*'))
shell.rm('-rf', path.resolve(__dirname, '../../public/fonts/.*'))
shell.rm('-rf', path.resolve(__dirname, '../../public/img/*'))
shell.rm('-rf', path.resolve(__dirname, '../../public/img/.*'))
shell.rm('-rf', path.resolve(__dirname, '../../public/js/*'))
shell.rm('-rf', path.resolve(__dirname, '../../public/js/.*'))
shell.rm('-rf', path.resolve(__dirname, '../../public/statics/*'))
shell.rm('-rf', path.resolve(__dirname, '../../public/statics/.*'))
shell.rm('-rf', path.resolve(__dirname, '../../public/app.*.css'))


console.log(' Cleaned build artifacts.\n')
