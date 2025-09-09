export function formatToInputDate(dateString) {
  return new Date(dateString).toISOString().split('T')[0];
}