
import http from 'k6/http';
import { htmlReport } from "https://raw.githubusercontent.com/benc-uk/k6-reporter/main/dist/bundle.js";

export function handleSummary(data) {
  return {
    "summary.html": htmlReport(data),
  };
}

import { check, sleep } from 'k6';

export let options = {
  stages: [
    { duration: '30s', target: 10 }, // Sobe para 10 usuários em 30 segundos
    { duration: '1m', target: 50 },  // Mantém 50 usuários por 1 minuto
    { duration: '30s', target: 0 },  // Diminui para 0 usuários em 30 segundos
  ],
};

export default function () {
  let res = http.get('https://labdados.com/produtos');

  check(res, {
    'status is 200': (r) => r.status === 200,
    'response time is less than 200ms': (r) => r.timings.duration < 200,
  });

  sleep(1);
}