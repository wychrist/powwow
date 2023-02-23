function fetchTableData(resource, _token) {
  return fetch(`/backend/table-json/${resource}`).then((response) => response.json());
}