export const convertTimehmsTohm = (timeStr) => {
  const [hours, minutes] = timeStr.split(':').map(Number);
  let result = '';

  if (hours > 0) { result += `${hours}h`; }
  if (minutes > 0 && hours !== 0) { result += `${minutes}`; }
  if (hours === 0) { result += `${minutes} min`; }

  return result;
}