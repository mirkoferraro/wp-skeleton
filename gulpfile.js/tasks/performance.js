module.exports = function ($, config) {
	return function () {
		return $.louis({
			url: config.localhost,
			timeout: 30,
			viewport: '1280x1024',
			engine: 'webkit',
			userAgent: 'Chrome/37.0.2062.120',
			outputFileName: 'performance_output.json',
			noExternals: false,
			performanceBudget: config.performanceBudget
		});
	};
};
