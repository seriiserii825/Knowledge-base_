#yarn
yarn global add gulp

#package.json
scripts
		"preinstall": "node -e \"if(process.env.npm_execpath.indexOf('yarn') === -1) throw new Error('You must use Yarn to install, not NPM')\""
