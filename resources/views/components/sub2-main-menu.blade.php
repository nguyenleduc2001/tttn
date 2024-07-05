@if ($checksub)
    <div class="sub-menu megamenu evo-mega-menu-brand">
			<div class="container">
				<div class="row">
					<div class="col-lg-2 col-sm-4 brand-col">
						<a href="/bosch" title="Bosch" class="menu-brands-logo">
							<img class="lazy" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC" data-src="https://bizweb.dktcdn.net/100/418/839/collections/bosh.jpg?v=1613550977477" alt="Bosch" />
						</a>
                        @foreach ($list_menu2 as $row_menu2)
                            <div class="level1">
							<a href="{{ route('slug.index',['slug'=>$row_menu2->link]) }}" title="{{ $row_menu2->name }}">{{ $row_menu2->name }}</a>
						</div>
                        @endforeach
					</div>
				</div>
			</div>
		</div>
@else
    <div class="sub-menu megamenu evo-mega-menu-brand">
			<div class="container">
				<div class="row">
					<div class="col-lg-2 col-sm-4 brand-col">
						<a href="/bosch" title="Bosch" class="menu-brands-logo">
							<img class="lazy" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC" data-src="https://bizweb.dktcdn.net/100/418/839/collections/bosh.jpg?v=1613550977477" alt="Bosch" />
						</a>
							<a href="{{ route('slug.index',['slug'=>$row_menu1->link]) }}" title="{{ $row_menu1->name }}">{{ $row_menu1->name }}</a>
					</div>
				</div>
			</div>
		</div>
@endif
		