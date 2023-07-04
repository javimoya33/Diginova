<div class="col-xs-4 pull-right text-right" style="">
			<button class="btn btn-default dropdown-toggle" type="button"
				id="menu1" data-toggle="dropdown" alt="Orden" title="Orden">
				<span class="glyphicon glyphicon-sort-by-alphabet"></span>
			</button>
			<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
				<li role="presentation"><a role="menuitem" tabindex="-1"
					href="{{URL::full()}}"
					onclick="app.cambiarOrden('{{URL::to('cambiarOrden/cuadros')}}');"><span class="glyphicon glyphicon-th-large"></span> {{T::tr('Vista de cuadrícula')}}</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1"
					href="{{URL::full()}}"
					onclick="app.cambiarOrden('{{URL::to('cambiarOrden/lista')}}');"><span class="glyphicon glyphicon-align-justify"></span> {{T::tr('Vista de lista')}}</a></li>
						<li role="presentation"><a role="menuitem" tabindex="-1"
					href="{{URL::full()}}"
					onclick="app.cambiarOrden('{{URL::to('cambiarOrden/da')}}');"><span class="glyphicon glyphicon-sort-by-attributes"></span> {{T::tr('Descripción')}}</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1"
					href="{{URL::full()}}"
					onclick="app.cambiarOrden('{{URL::to('cambiarOrden/ca')}}');"><span class="glyphicon glyphicon-sort-by-attributes"></span> {{T::tr('Código')}}</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1"
					href="{{URL::full()}}"
					onclick="app.cambiarOrden('{{URL::to('cambiarOrden/pa')}}')"><span class="glyphicon glyphicon-sort-by-attributes"></span> {{T::tr('Precio')}}</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1"
					href="{{URL::full()}}"
					onclick="app.cambiarOrden('{{URL::to('cambiarOrden/ma')}}')"><span class="glyphicon glyphicon-sort-by-attributes"></span> {{T::tr('Marca')}}</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1"
					href="{{URL::full()}}"
					onclick="app.cambiarOrden('{{URL::to('cambiarOrden/sa')}}')"><span class="glyphicon glyphicon-sort-by-attributes"></span> {{T::tr('Stock')}}</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1"
					href="{{URL::full()}}"
					onclick="app.cambiarOrden('{{URL::to('cambiarOrden/dd')}}')"><span class="glyphicon glyphicon-sort-by-attributes-alt"></span> {{T::tr('Descripción')}}</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1"
					href="{{URL::full()}}"
					onclick="app.cambiarOrden('{{URL::to('cambiarOrden/cd')}}')"><span class="glyphicon glyphicon-sort-by-attributes-alt"></span> {{T::tr('Código')}}</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1"
					href="{{URL::full()}}"
					onclick="app.cambiarOrden('{{URL::to('cambiarOrden/pd')}}')"><span class="glyphicon glyphicon-sort-by-attributes-alt"></span> {{T::tr('Precio')}}</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1"
					href="{{URL::full()}}"
					onclick="app.cambiarOrden('{{URL::to('cambiarOrden/md')}}')"><span class="glyphicon glyphicon-sort-by-attributes-alt"></span> {{T::tr('Marca')}}</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1"
					href="{{URL::full()}}"
					onclick="app.cambiarOrden('{{URL::to('cambiarOrden/sd')}}')"><span class="glyphicon glyphicon-sort-by-attributes-alt"></span> {{T::tr('Stock')}}</a></li>
			</ul>
		</div>
