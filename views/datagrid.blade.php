

<div class="rpd-datagrid">

    <div class="rapyd-massbuttons">
        @include('rapyd::massbuttontop')
    </div>

    @include('rapyd::toolbar', array('label'=>$label, 'buttons_right'=>$buttons['TR']))


    <div class="table-responsive">
        <table{!! $dg->buildAttributes() !!}>
            <thead>
            <tr>
                @foreach ($dg->columns as $column)
                    <th{!! $column->buildAttributes() !!}>

                        @if ($column instanceof \Zofe\Rapyd\DataGrid\CheckboxColumn)

                            <input type="checkbox" data-masscheckbox-head />

                        @else

                            @if ($column->orderby)
                                @if ($dg->onOrderby($column->orderby_field, 'asc'))
                                    <span class="glyphicon glyphicon-chevron-up"></span>
                                @else
                                    <a href="{{ $dg->orderbyLink($column->orderby_field,'asc') }}">
                                        <span class="glyphicon glyphicon-chevron-up"></span>
                                    </a>
                                @endif
                                @if ($dg->onOrderby($column->orderby_field, 'desc'))
                                    <span class="glyphicon glyphicon-chevron-down"></span>
                                @else
                                    <a href="{{ $dg->orderbyLink($column->orderby_field,'desc') }}">
                                        <span class="glyphicon glyphicon-chevron-down"></span>
                                    </a>
                                @endif
                            @endif
                            {!! $column->label !!}

                        @endif
                    </th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @if (count($dg->rows) == 0)
                <tr><td colspan="{!! count($dg->columns) !!}">{!! trans('rapyd::rapyd.no_records') !!}</td></tr>
            @endif
            @foreach ($dg->rows as $row)
                <tr{!! $row->buildAttributes() !!}>
                    @foreach ($row->cells as $cell)
                        <td{!! $cell->buildAttributes() !!}>{!! $cell->value !!}</td>
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="btn-toolbar" role="toolbar">
        @if ($dg->havePagination())
            <div class="pull-left">
                {!! $dg->links() !!}
            </div>
            <div class="pull-right rpd-total-rows">
                {{ trans('rapyd::rapyd.total_rows') }}: {!! $dg->totalRows() !!}
            </div>
        @endif
    </div>

    <div class="rapyd-massbuttons">
        @include('rapyd::massbuttons')
    </div>

</div>

{!! Rapyd::scripts() !!}
