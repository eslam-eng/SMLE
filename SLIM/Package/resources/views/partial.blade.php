<span class="btn btn-dark" style="margin:10px 10px 10px 10px">Total ({{ $packages->total() }})</span>

<table class="table table-vcenter table-mobile-md card-table">
    <thead>
        <tr>

            <th>#</th>
            <th>Name</th>
            <th>Final Price</th>
            <th>Specialities</th>
            <th>Monthly Price</th>
            <th>Yearly Price</th>
            <th>No.Quiz available</th>
            <th>No.Question available Quiz </th>
            <th>Is Active</th>
            <th class="w-1">Control</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($packages as $index => $package)
            <tr>
                <td class="text-secondary">
                    {{ ++$index }}
                </td>
                <td class="text-secondary" data-label="Role">
                    {{ $package->name }}
                </td>
                <td class="text-secondary" data-label="Role">
                    {{ $package->price }}
                </td>
                <td class="text-secondary" data-label="Role">
                    {{ $package->specialist->pluck('name')->implode(', ') }}
                </td>
                <td class="text-secondary" data-label="Role">
                    {{ $package->monthly_price }}
                </td>
                <td class="text-secondary" data-label="Role">
                    {{ $package->yearly_price }}
                </td>
                <td class="text-secondary" data-label="Role">
                    {{ $package->no_limit_for_quiz ? 'No Limit' : $package->num_available_quiz }}
                </td>
                <td class="text-secondary" data-label="Role">
                    {{ $package->no_limit_for_question ? 'No Limit' : $package->num_available_question }}
                </td>
                <td class="text-secondary" data-label="Role">
                    {{ $package->is_active ? 'Yes' : 'No' }}
                </td>
                <td>
                    <div class="btn-list flex-nowrap">
                        <div class="dropdown">
                            <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                                Actions
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="{{ route('package.edit', $package->id) }}" class="dropdown-item">
                                    edit
                                </a>
                                <a class="dropdown-item delete" href="{{ route('package.destroy', $package->id) }}">
                                    Delete
                                </a>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>

</table>

{!! $packages->render() !!}
