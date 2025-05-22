import express from 'express';
import cors from 'cors';
import { exec } from 'child_process';

const app = express();
app.use(cors());
app.use(express.json());

const run = (cmd) =>
  new Promise((resolve, reject) =>
    exec(cmd, (error, stdout, stderr) => {
      if (error) return reject(stderr);
      resolve(stdout);
    })
  );

app.get('/containers', async (req, res) => {
  const label = req.query.label; // ex: "cliente=client1"
  let cmd = 'docker ps -a';

  if (label) {
    cmd += ` --filter "label=${label}"`;
  }

  // use aspas corretamente
  cmd += ` --format "{{.Names}}: {{.Status}}"`;

  try {
    const out = await run(cmd);
    res.json(out.trim().split('\n'));
  } catch (err) {
    res.status(500).json({ error: err });
  }
});

app.post('/start', async (req, res) => {
  const { container } = req.body;
  try {
    const out = await run(`docker start ${container}`);
    res.json({ started: out.trim() });
  } catch (err) {
    res.status(500).json({ error: err });
  }
});

app.post('/stop', async (req, res) => {
  const { container } = req.body;
  try {
    const out = await run(`docker stop ${container}`);
    res.json({ stopped: out.trim() });
  } catch (err) {
    res.status(500).json({ error: err });
  }
});

app.post('/restart', async (req, res) => {
  const { container } = req.body;
  try {
    const out = await run(`docker restart ${container}`);
    res.json({ restarted: out.trim() });
  } catch (err) {
    res.status(500).json({ error: err });
  }
});

app.listen(3000, () => console.log('🟢 DockerCTL API listening on port 3000'));
