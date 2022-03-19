<table>
    <thead>
        <tr>
            <th>{{ __('ID') }}</th>
            <th>{{ __('First Name') }}</th>
            <th>{{ __('Last Name') }}</th>
            <th>{{ __('Gener') }}</th>
            <th>{{ __('Date of Birth') }}</th>
            <th>{{ __('Nationality') }}</th>
            <th>{{ __('Phone') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($students as $key_student => $student)
            <tr>
                <td>{{ $student->id }}</td>

                <td>
                    {{ $student->first_name }}
                </td>
                <td>{{ $student->last_name }}</td>
                <td>
                    {{ $student->gender }}
                </td>
                <td>{{ $student->date_of_birth }}</td>
                <td>{{ $student->nationality }}</td>
                <td>{{ $student->phone }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
