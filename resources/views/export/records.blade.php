<table>
    <thead>
    <tr>
        <th>Наименование</th>
        <th>ОГРН</th>
        <th>ИНН</th>
        <th>КПП</th>
        <th>Адрес</th>
        <th>Руководитель</th>
    </tr>
    </thead>
    <tbody>
    @foreach($records as $record)
        <tr>
            <td>{{ $record->name }}</td>
            <td>{{ $record->ogrn }}</td>
            <td>{{ $record->inn }}</td>
            <td>{{ $record->cpp }}</td>
            <td>{{ $record->address }}</td>
            <td>{{ $record->director }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
