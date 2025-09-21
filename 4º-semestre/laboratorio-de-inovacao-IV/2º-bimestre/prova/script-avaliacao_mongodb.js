// Conectar ao banco de dados correto
use('trabalhoFinal');

// ---------------------------------------------------------------------------------
// 1 - Encontre todos os usuários que têm um saldo superior a $3.000.
use('trabalhoFinal');
print("\n1. Usuários com saldo > $3000:\n");
db.usuarios.find({ balance: { $gt: "$3,000.00"}});

// ---------------------------------------------------------------------------------
// 2 - Recupere todos os usuários com uma cor de olho específica, por exemplo, azul.
use('trabalhoFinal');
print("\n2. Usuários com olhos azuis:\n");
db.usuarios.find({ eyeColor: "blue" });

// ---------------------------------------------------------------------------------
// 3 - Liste todos os usuários que estão ativos.
use('trabalhoFinal');
print("\n3. Usuários ativos:\n");
db.usuarios.find({ isActive: true });

// ---------------------------------------------------------------------------------
// 4 - Encontre todos os usuários que têm 'morango' como fruta favorita.
use('trabalhoFinal');
print("\n4. Usuários que gostam de morango:\n");
db.usuarios.find({ favoriteFruit: "strawberry" });

// ---------------------------------------------------------------------------------
// 5 - Recupere o nome, idade e empresa de todos os usuários.
use('trabalhoFinal');
print("\n5. Nome, idade e empresa de todos os usuários:\n");
db.usuarios.find({}, { name: 1, age: 1, company: 1, _id: 0 });

// ---------------------------------------------------------------------------------
// 6 - Encontre usuários com saldo inferior a $2.600.
use('trabalhoFinal');
print("\n6. Usuários com saldo < $2600:\n");
db.usuarios.find({ balance: { $lt: "2,600.00" } });

// ---------------------------------------------------------------------------------
// 7 - Conte o número de usuários ativos.
use('trabalhoFinal');
print("\n7. Número de usuários ativos:\n");
db.usuarios.countDocuments({ isActive: true });

// ---------------------------------------------------------------------------------
// 8 - Encontre todos os usuários que têm um número de telefone que começa com "+1 (967)".
use('trabalhoFinal');
print("\n8. Usuários com telefone começando com +1 (967):\n");
db.usuarios.find({ phone: { $regex: /^\+1 \(967\)/ } });

// ---------------------------------------------------------------------------------
// 9 - Recupere usuários cujo endereço contenha 'New Hampshire'.
use('trabalhoFinal');
print("\n9. Usuários cujo endereço contém 'New Hampshire':\n");
db.usuarios.find({ address: { $regex: /New Hampshire/ } });

// ---------------------------------------------------------------------------------
// 10 - Encontre usuários que têm mais de 3 amigos listados.
use('trabalhoFinal');
print("\n10. Usuários com mais de 3 amigos:\n");
db.usuarios.find({ $expr: { $gt: [{ $size: "$friends" }, 3] } });

// ---------------------------------------------------------------------------------
// 19 - Recupere o 'nome' e 'endereço' de usuários que não estão ativos.
use('trabalhoFinal');
print("\n19. Nome e endereço de usuários inativos:\n");
db.usuarios.find({ isActive: false }, { name: 1, address: 1, _id: 0 });

// ---------------------------------------------------------------------------------
// 11 - Atualize o campo 'isActive' para verdadeiro para os usuários que estão inativos.
use('trabalhoFinal');
print("\n11. Atualizando usuários inativos para ativos:\n");
db.usuarios.updateMany(
  { isActive: false },
  { $set: { isActive: true } }
);

// ---------------------------------------------------------------------------------
// 12 - Encontre todos os usuários que se registraram após '2024-01-01'.
use('trabalhoFinal');
print("\n12. Usuários registrados após 2024-01-01:\n");
db.usuarios.find({ registered: { $gt: "2024-01-01T00:00:00Z" } });

// ---------------------------------------------------------------------------------
// 13 - Conte o número de usuários que têm 'sit' como uma tag.
use('trabalhoFinal');
print("\n13. Número de usuários com a tag 'sit':\n");
db.usuarios.countDocuments({ tags: "sit" });

// ---------------------------------------------------------------------------------
// 14 - Recupere todos os usuários com o domínio de e-mail 'ecosys.com'.
use('trabalhoFinal');
print("\n14. Usuários com email @ecosys.com:\n");
db.usuarios.find({ email: { $regex: /@ecosys\.com$/ } });

// ---------------------------------------------------------------------------------
// 15 - Encontre todos os usuários cujo nome comece com a letra 'E'.
use('trabalhoFinal');
print("\n15. Usuários cujo nome começa com 'E':\n");
db.usuarios.find({ name: { $regex: /^E/ } });

// ---------------------------------------------------------------------------------
// 16 - Encontre todos os usuários que têm uma latitude maior que 0.
use('trabalhoFinal');
print("\n16. Usuários com latitude > 0:\n");
db.usuarios.find({ latitude: { $gt: 0 } });

// ---------------------------------------------------------------------------------
// 17 - Atualize o campo 'about' para usuários cujo saldo seja inferior a $2.600, para incluir 'Precisa de assistência financeira.'.
use('trabalhoFinal');
print("\n17. Atualizando 'about' de usuários com saldo < $2600:\n");
db.usuarios.updateMany(
  { balance: { $lt: 2600 } },
  { $set: { about: "Precisa de assistência financeira." } }
);

// ---------------------------------------------------------------------------------
// 18 - Encontre usuários que têm um saldo entre $2.500 e $3.000.
use('trabalhoFinal');
print("\n18. Usuários com saldo entre $2500 e $3000:\n");
db.usuarios.find({ balance: { $gte: "$2,500.00", $lte: "$3.000.00" } });

// ---------------------------------------------------------------------------------
// 20 - Encontre usuários que têm pelo menos um amigo chamado 'Beatriz Skinner'.
use('trabalhoFinal');
print("\n20. Usuários com um amigo chamado 'Beatriz Skinner':\n");
db.usuarios.find({ "friends.name": "Beatriz Skinner" });