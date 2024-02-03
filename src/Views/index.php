<?php
/**
 * Code output and query view file.
 *
 * @since 1.0.0
 *
 * @package WpTinker
 */

?>

<?php require_once 'partials/header.php'; ?>

	<div class="wptinker-wrapper">
		<input type="hidden" name="_wpnonce" value="<?php echo esc_attr( wp_create_nonce( 'wp_tinker' ) ); ?>">
		<div class="input">
				<p>Write Code</p>
				<textarea id="code" name="code" ng-model="model.code" rows="10" 
				ng-keydown="listenEvent($event)"
				style="width: 99%;"></textarea>

				<button class="button" 
				ng-disabled="processing || !model.code"
				type="button" ng-click="getOutput(model)">{{processing? 'Running...':'► Run'}}</button>
		</div>

		<div class="output">
			<div class="tabs">
				<div ng-click="setTab('output')" ng-class="tab==='output'?'active':''">Output</div>
				<div ng-show="queries.length" ng-class="tab==='sql'?'active':''" ng-click="setTab('sql')">SQL ({{queries.length}})</div>
			</div>

			<pre ng-show="tab==='output'">{{output}}</pre>
			<!-- SQL query tab -->
			<div ng-show="tab=== 'sql' && queries.length">
				<div class="sql-query-wrapper" ng-repeat="row in queries track by $index">
					<p class="query-info">
						<span class="query-time">{{row.query_time|number:5}}</span>
						<span class="query-copy" ng-click="copy(row.query,$event)">Copy</span>
					</p>
					<pre class="sql-query">{{row.query}}</pre>
				</div>
			</div>
			<!-- SQL query tab end -->
		</div>
	</div>

</div>
<!-- ng app close -->

