@php
$columns = isset($columns) ? $columns : 1;
@endphp
<div class="row mx-0" id="{{ isset($id) ? $id : '' }}">
    <div class="col-xl-6 col-4 pl-0">
        @if(count($filters))
            <div class="dropdown d-inline mr-2">
                <button class="btn btn-primary btn-sm dropdown-toggle mr-2"
                    type="button"
                    id="filterMenu"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false">
                    <i class="fa fa-filter mr-2"></i>Filters
                </button>
                <div class="dropdown-menu p-3" aria-labelledby="filterMenu" style="width: {{ $columns == 2 ? '350px' : 'auto' }}">
                    <form action="{{ $endpoint }}">
                        <div class="{{ $columns == 2 ? 'row' : '' }}">
                            @foreach($filters as $filter)
                                <div class="{{ $columns == 2 ? 'col-lg-6' : '' }} {{ isset($filter['class']) ? $filter['class'] : '' }}">
                                    <label class="mr-1 d-block">
                                        <h6 class="my-2 text-muted">{{ $filter['label'] }}</h6>
                                        @if (stripos($filter['label'], 'date') !== false)
                                            <input type="text"
                                            name="{{ $filter['field_name'] }}"
                                            class="form-control datetimepicker font-size-sm">
                                        @else
                                            <select name="{{ $filter['field_name'] }}"
                                                class="form-control form-control-sm"
                                            >
                                                <option value=""></option>
                                                @foreach($filter['options'] as $value => $label)
                                                    <option value="{{ $value }}"
                                                        {{ isset($_GET[$filter['field_name']]) &&
                                                            $_GET[$filter['field_name']] != '' &&
                                                            $_GET[$filter['field_name']] == $value ? 'selected' : ''
                                                        }}>
                                                        {{ $label }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <input type="submit"
                        name="filter_action"
                        class="btn btn-sm btn-primary search-submit w-100 mt-2"
                        value="Apply Filter">
                    </form>
                </div>
            </div>
        @endif
        @if(request()->has('filter_action') || request()->has('q'))
            <a class="btn btn-outline-primary btn-sm clear-filters" href="{{ $endpoint }}">
                Clear Filters
            </a>
            <span class="ml-3"><b>Search Results:</b>
                @if($total == 0)
                    0 found.
                @else
                    {{ $total > 1 ? $total . ' ' . $model['plural'] : $total . ' ' . $model['singular'] }}
                @endif
            </span>
        @endif
    </div>
    @if($search)
        <div class="col-xl-6 col-8 pr-0">
            <form action="{{ $endpoint }}">
                <div class="text-right">
                    <label>
                        <input name='q'
                        value="{{ request()->get('q') }}"
                        placeholder="Search {{ $model['plural'] }}..."
                        type="text"
                        class="form-control form-control-sm">
                    </label>
                    <span class="input-group-btn">
                        <button class="btn btn-sm btn-secondary search-submit" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </form>
        </div>
    @endif
</div>
