## Pregunta5: Conteo inicial

> [
.     "users" => App\Models\User::count(),
.     "categories" => App\Models\Category::count(),
.     "notes" => App\Models\Note::count(),
.     "note_user" => DB::table('note_user')->count()
. ]

= [
    "users" => 6,
    "categories" => 19,
    "notes" => 15,
    "note_user" => 37,
  ]

**Respuesta/Conclusion:** se muestra e conteo total

## Pregunta6: Notas propias de un usuario

> $admin = App\Models\User::where('email', 'admin@uatf.bo')->first();

= App\Models\User {#7539
    id: 6,
    name: "Administrador",
    email: "admin@uatf.bo",
    email_verified_at: null,
    #password: "\$2y\$12\$OAaWAtBSzD34LqzXtlMd5u2E1VN1t.nxiyZnsEMqWfuRxNXGXg3Ni",
    #remember_token: null,
    created_at: "2026-04-24 13:30:50",
    updated_at: "2026-04-24 13:30:50",
  }

> $admin->notes()->wherePivot('role', 'owner')->pluck('title');

= Illuminate\Support\Collection {#7468
    all: [
      "Debitis libero sed quas.",
      "Eum qui quis dolor.",
      "Sint est quam tempore vitae.",
      "Hic eos est porro.",
      "Quas id et ut.",
      "Consequatur ad libero.",
      "In quam animi fuga quo illum.",
      "Non at voluptas modi.",
      "Est velit natus autem.",
      "Omnis in consequatur pariatur similique velit.",
      "Dolore recusandae et autem et.",
      "Reprehenderit quia ipsam ut qui.",
      "Dignissimos velit consequatur sint minus.",
      "Cum occaecati delectus asperiores.",
      "Maxime ut qui eos et voluptatem.",
    ],
  }

**Respuesta/Conclusion:** se muestra las notas del usuario admin

## Pregunta7: Compartir una nota

$nuevo = App\Models\User::create(['name' => 'Colaborador Test', 'email' => 'test_final@uatf.bo', 'password' => bcrypt('password')]);

= App\Models\User {#7529
    name: "Colaborador Test",
    email: "test_final@uatf.bo",
    #password: "\$2y\$12\$ZZQnvk4Ew8/MkyWr2Dvlfu9IE/DyD/DkzdfasMXuCqpAqsIk.oxxi",
    updated_at: "2026-04-24 13:46:00",
    created_at: "2026-04-24 13:46:00",
    id: 8,
  }

> $nota = App\Models\User::where('email', 'admin@uatf.bo')->first()->notes()->wherePivot('role', 'owner')->first();

= App\Models\Note {#8269
    id: 1,
    title: "Debitis libero sed quas.",
    content: <<<EOS
      Ratione iusto voluptatem inventore ratione. Quam ab recusandae voluptatum quos esse voluptatem impedit. Hic ipsum vel esse minus dignissimos iure.

      Et et ut et ab esse nam. Eum molestiae alias atque enim maiores dolorum. Incidunt illum laborum occaecati aperiam ab voluptatem.

      Deserunt aut molestiae dolores nostrum minus culpa. Dolorem eum qui asperiores recusandae earum tenetur molestiae. Possimus in vitae dolorem et. Dolor reiciendis reprehenderit rerum a consequuntur nemo.
      EOS,
    is_public: false,
    category_id: 5,
    created_at: "2026-04-24 13:30:50",
    updated_at: "2026-04-24 13:30:50",
    pivot: Illuminate\Database\Eloquent\Relations\Pivot {#7379
      user_id: 6,
      note_id: 1,
      role: "owner",
      created_at: "2026-04-24 13:30:50",
      updated_at: "2026-04-24 13:30:50",
    },
  }

> $nota->users()->attach($nuevo->id, ['role' => 'editor']);

= null

> $nota->load('users')->users->map(fn($u) => $u->name . ' - Role: ' . $u->pivot->role);

= Illuminate\Support\Collection {#8150
    all: [
      "Dr. Rodger Kshlerin II - Role: viewer",
      "Administrador - Role: owner",
      "Colaborador Test - Role: editor",
    ],
  }

**Respuesta/Conclusion:** Se creó un nuevo usuario y se vinculó exitosamente a la nota con el rol de editor usando el método attach

## Pregunta8: Actualizar un rol en el pivote

> $nota->users()->updateExistingPivot($nuevo->id, ['role' => 'viewer']);

= 1

> $nota->users()->where('user_id', $nuevo->id)->first()->pivot->role;

= "viewer"

**Respuesta/Conclusion:** Se cambio el rol del usuario mediante la propiedad pivot

## Pregunta9: Categorias mas populares

> App\Models\Category::withCount('notes')->orderByDesc('notes_count')->get(['name', 'notes_count']);

= Illuminate\Database\Eloquent\Collection {#8294
    all: [
      App\Models\Category {#7505
        id: 19,
        name: "fuga eius",
        description: "Dolorum laboriosam non itaque quibusdam dignissimos aperiam eos id doloremque nemo ipsa adipisci.",
        created_at: "2026-04-24 13:30:50",
        updated_at: "2026-04-24 13:30:50",
        notes_count: 1,
      },
      App\Models\Category {#7524
        id: 15,
        name: "nam et",
        description: "Accusamus voluptas quam voluptate expedita et maxime non quia nesciunt maiores aut ad.",
        created_at: "2026-04-24 13:30:50",
        updated_at: "2026-04-24 13:30:50",
        notes_count: 1,
      },
      App\Models\Category {#7376
        id: 16,
        name: "atque quo",
        description: "Rerum et quidem magni fugit dolor quo velit cum.",
        created_at: "2026-04-24 13:30:50",
        updated_at: "2026-04-24 13:30:50",
        notes_count: 1,
      },
      App\Models\Category {#7478
        id: 17,
        name: "asperiores voluptatem",
        description: "Nesciunt beatae temporibus maiores nostrum architecto modi minus doloribus reiciendis.",
        created_at: "2026-04-24 13:30:50",
        updated_at: "2026-04-24 13:30:50",
        notes_count: 1,
      },
      App\Models\Category {#8151
        id: 18,
        name: "dolor corrupti",
        description: "Dolor cupiditate exercitationem minus ex aspernatur similique iure voluptatem.",
        created_at: "2026-04-24 13:30:50",
        updated_at: "2026-04-24 13:30:50",
        notes_count: 1,
      },
      App\Models\Category {#7511
        id: 5,
        name: "quas labore",
        description: "Maiores sit rem iure et dolores vel et placeat ut distinctio quia non.",
        created_at: "2026-04-24 13:30:50",
        updated_at: "2026-04-24 13:30:50",
        notes_count: 1,
      },
      App\Models\Category {#7510
        id: 6,
        name: "fugit ut",
        description: "Excepturi architecto eos et ut ad magni nisi consectetur atque ab nemo qui minima.",
        created_at: "2026-04-24 13:30:50",
        updated_at: "2026-04-24 13:30:50",
        notes_count: 1,
      },
      App\Models\Category {#7509
        id: 7,
        name: "ea nobis",
        description: "Optio dolore beatae enim cum consequatur saepe quisquam delectus culpa sint aut.",
        created_at: "2026-04-24 13:30:50",
        updated_at: "2026-04-24 13:30:50",
        notes_count: 1,
      },
      App\Models\Category {#7487
        id: 8,
        name: "sed non",
        description: "Beatae inventore commodi ab omnis voluptas quia dicta.",
        created_at: "2026-04-24 13:30:50",
        updated_at: "2026-04-24 13:30:50",
        notes_count: 1,
      },
      App\Models\Category {#7522
        id: 9,
        name: "consequatur qui",
        description: "A quo impedit similique reiciendis incidunt perferendis aut deserunt quia corporis.",
        created_at: "2026-04-24 13:30:50",
        updated_at: "2026-04-24 13:30:50",
        notes_count: 1,
      },
      App\Models\Category {#7521
        id: 10,
        name: "eum quia",
        description: "Nulla quasi animi nihil illo itaque molestiae aut culpa amet aut debitis et quos.",
        created_at: "2026-04-24 13:30:50",
        updated_at: "2026-04-24 13:30:50",
        notes_count: 1,
      },
      App\Models\Category {#7520
        id: 11,
        name: "veritatis quibusdam",
        description: "Dolores veniam occaecati sed recusandae est accusamus laborum animi accusantium mollitia.",
        created_at: "2026-04-24 13:30:50",
        updated_at: "2026-04-24 13:30:50",
        notes_count: 1,
      },
      App\Models\Category {#7519
        id: 12,
        name: "autem animi",
        description: "Porro sit et eos repellendus reprehenderit voluptates blanditiis aut reprehenderit incidunt id nulla ad.",
        created_at: "2026-04-24 13:30:50",
        updated_at: "2026-04-24 13:30:50",
        notes_count: 1,
      },
      App\Models\Category {#7515
        id: 13,
        name: "illum necessitatibus",
        description: "Maiores laborum iure qui in harum quo.",
        created_at: "2026-04-24 13:30:50",
        updated_at: "2026-04-24 13:30:50",
        notes_count: 1,
      },
      App\Models\Category {#7516
        id: 14,
        name: "sint amet",
        description: "Quaerat officiis qui culpa veniam rerum et odio voluptatem dolore ad.",
        created_at: "2026-04-24 13:30:50",
        updated_at: "2026-04-24 13:30:50",
        notes_count: 1,
      },
      App\Models\Category {#7517
        id: 2,
        name: "Estudio",
        description: null,
        created_at: "2026-04-24 13:30:50",
        updated_at: "2026-04-24 13:30:50",
        notes_count: 0,
      },
      App\Models\Category {#7518
        id: 3,
        name: "Personal",
        description: null,
        created_at: "2026-04-24 13:30:50",
        updated_at: "2026-04-24 13:30:50",
        notes_count: 0,
      },
      App\Models\Category {#8296
        id: 4,
        name: "Ideas",
        description: null,
        created_at: "2026-04-24 13:30:50",
        updated_at: "2026-04-24 13:30:50",
        notes_count: 0,
      },
      App\Models\Category {#8295
        id: 1,
        name: "Trabajo",
        description: null,
        created_at: "2026-04-24 13:30:50",
        updated_at: "2026-04-24 13:30:50",
        notes_count: 0,
      },
    ],
  }

**Respuesta:** El uso de withCount permite obtener el total de relaciones por cada categoría, facilitando el ordenamiento por popularidad

## Pregunta10: Notas publicas compartidas

> App\Models\Note::where('is_public', true)->has('users', '>=', 2)->withCount('users')->get(['title', 'users_count']);

= Illuminate\Database\Eloquent\Collection {#7427
    all: [
      App\Models\Note {#7471
        id: 4,
        title: "Hic eos est porro.",
        content: <<<EOS
          Vitae nam nesciunt totam adipisci. Sed ut sunt cumque vero. Ullam veniam dolore eum sed.

          Dolorem sit suscipit voluptate. Facilis et autem ipsam tenetur est eos. Esse incidunt temporibus sit. Animi atque quia debitis dolorem facere natus illum.

          Architecto voluptatum dolorem porro repudiandae molestias. Omnis consequatur ab quia saepe. Impedit inventore consectetur perferendis nihil ipsum fugit occaecati. Distinctio quia quia pariatur delectus aut.
          EOS,
        is_public: true,
        category_id: 8,
        created_at: "2026-04-24 13:30:50",
        updated_at: "2026-04-24 13:30:50",
        users_count: 2,
      },
      App\Models\Note {#7496
        id: 8,
        title: "Non at voluptas modi.",
        content: <<<EOS
          Deleniti consequatur ut excepturi illum quasi molestias esse. Ut autem velit quo illo ullam itaque. Id unde quis eum qui recusandae cum esse fuga. Voluptas provident eos incidunt esse animi ipsa suscipit labore.

          Velit quia iure in qui. Odio quasi ut pariatur reiciendis dolor ipsa vero. Illo provident est alias aut vel at. Quidem eum id dolorem qui ipsam.

          Sit ut tempore voluptatum repellendus nam. Recusandae tempore porro unde et odit quo. Cumque quidem natus libero nam quos quos minus. Enim quo dolorum voluptas placeat.
          EOS,
        is_public: true,
        category_id: 12,
        created_at: "2026-04-24 13:30:50",
        updated_at: "2026-04-24 13:30:50",
        users_count: 3,
      },
      App\Models\Note {#7405
        id: 10,
        title: "Omnis in consequatur pariatur similique velit.",
        content: <<<EOS
          Voluptatibus voluptas est dicta tenetur. Molestiae voluptatem non perspiciatis aut enim non. Sint corporis officiis sunt. Perferendis ut vero consequatur quia repellat tempora distinctio.

          Velit non repellendus ipsa blanditiis. Illo labore deleniti iste quia nostrum. Soluta natus est optio velit aut voluptatum.

          Earum ea aut aspernatur nostrum. Enim magni alias quae iusto debitis provident accusantium molestiae. Ut quod reiciendis et ea tempore in repellat. Voluptatibus quisquam assumenda eligendi id at dolor.
          EOS,
        is_public: true,
        category_id: 14,
        created_at: "2026-04-24 13:30:50",
        updated_at: "2026-04-24 13:30:50",
        users_count: 2,
      },
      App\Models\Note {#7493
        id: 11,
        title: "Dolore recusandae et autem et.",
        content: <<<EOS
          Suscipit labore officiis ut expedita facilis aut sed. Natus at impedit adipisci sed.

          Harum nihil omnis optio esse dolorem nisi et. Quia quia voluptatem eum deserunt maxime. Enim et impedit exercitationem quo.

          Aut quo provident voluptas fuga quos natus. Dicta in voluptatibus omnis autem iusto. Officiis dolores non consequatur autem voluptates delectus esse. Non suscipit quasi aut. Debitis voluptatibus eum beatae.
          EOS,
        is_public: true,
        category_id: 15,
        created_at: "2026-04-24 13:30:50",
        updated_at: "2026-04-24 13:30:50",
        users_count: 2,
      },
      App\Models\Note {#7531
        id: 12,
        title: "Reprehenderit quia ipsam ut qui.",
        content: <<<EOS
          Quasi non et architecto labore omnis quibusdam beatae. Labore nam quisquam excepturi. Ipsam quia voluptas alias autem nesciunt aut eos. Sit labore earum eius eos.

          Aut sed praesentium quisquam dignissimos aut. Similique cumque aut sapiente. Et animi ipsum nobis deserunt quo.

          Illum iure repudiandae illum quam. Sed officia ex est libero autem doloremque molestiae. Dolorem neque sed recusandae numquam laudantium pariatur tempora.
          EOS,
        is_public: true,
        category_id: 16,
        created_at: "2026-04-24 13:30:50",
        updated_at: "2026-04-24 13:30:50",
        users_count: 3,
      },
      App\Models\Note {#7537
        id: 13,
        title: "Dignissimos velit consequatur sint minus.",
        content: <<<EOS
          Quia animi hic ut laborum rerum nulla. Et quod commodi eius id voluptates. Et esse velit alias nulla.

          Consectetur consequuntur impedit dolores. Velit ducimus natus dolorem quia. Sunt nihil natus voluptatem repudiandae est. Sint et et repellat aut eos commodi iusto.

          Occaecati nobis hic fuga tempore soluta alias officia. Earum molestias beatae incidunt illo enim neque porro. Voluptas illum aut voluptatibus veniam adipisci excepturi. Corrupti non dolor est sit ut.
          EOS,
        is_public: true,
        category_id: 17,
        created_at: "2026-04-24 13:30:50",
        updated_at: "2026-04-24 13:30:50",
        users_count: 3,
      },
    ],
  }

**Respuesta:** Se combinaron filtros de atributos locales con restricciones de existencia en la relación para identificar notas colaborativas públicas.

## Pregunta11: Ususario con mas notas propias



## Pregunta12: Desvincular y verificar

> $notaM = App\Models\Note::has('users', '>=', 3)->first();

= App\Models\Note {#8290
    id: 1,
    title: "Debitis libero sed quas.",
    content: <<<EOS
      Ratione iusto voluptatem inventore ratione. Quam ab recusandae voluptatum quos esse voluptatem impedit. Hic ipsum vel esse minus dignissimos iure.

      Et et ut et ab esse nam. Eum molestiae alias atque enim maiores dolorum. Incidunt illum laborum occaecati aperiam ab voluptatem.

      Deserunt aut molestiae dolores nostrum minus culpa. Dolorem eum qui asperiores recusandae earum tenetur molestiae. Possimus in vitae dolorem et. Dolor reiciendis reprehenderit rerum a consequuntur nemo.
      EOS,
    is_public: false,
    category_id: 5,
    created_at: "2026-04-24 13:30:50",
    updated_at: "2026-04-24 13:30:50",
  }

> $antes = $notaM->users()->count();

= 3

> $colab = $notaM->users()->wherePivot('role', '!=', 'owner')->first();

= App\Models\User {#8567
    id: 4,
    name: "Dr. Rodger Kshlerin II",
    email: "magali60@example.org",
    email_verified_at: "2026-04-24 13:30:49",
    #password: "\$2y\$12\$BnWz5ZKwXuSF8je6k7ku3O25Fd5X1vrmRxQVad7Q2XE64V/blaW8u",
    #remember_token: "yAzTAPwDAG",
    created_at: "2026-04-24 13:30:49",
    updated_at: "2026-04-24 13:30:49",
    pivot: Illuminate\Database\Eloquent\Relations\Pivot {#8649
      note_id: 1,
      user_id: 4,
      role: "viewer",
      created_at: "2026-04-24 13:30:50",
      updated_at: "2026-04-24 13:30:50",
    },
  }

> $notaM->users()->detach($colab->id);

= 1

> $despues = $notaM->users()->count();

= 2

> ['Conteo_Antes' => $antes, 'Conteo_Despues' => $despues]

= [
    "Conteo_Antes" => 3,
    "Conteo_Despues" => 2,
  ]

**Respuesta:** El método detach eliminó la relación específica en la tabla pivote, reduciendo el conteo de usuarios sin eliminar el registro del colaborador en la tabla users.


## Pregunta13: Eliminacion en cascada

> $cat = App\Models\Category::has('notes')->first();

= App\Models\Category {#8292
    id: 5,
    name: "quas labore",
    description: "Maiores sit rem iure et dolores vel et placeat ut distinctio quia non.",
    created_at: "2026-04-24 13:30:50",
    updated_at: "2026-04-24 13:30:50",
  }

> $ids = $cat->notes->pluck('id');

= Illuminate\Support\Collection {#8696
    all: [
      1,
    ],
  }

> $cat->delete();

= true

> [
.     "Notas_Huérfanas" => App\Models\Note::whereIn('id', $ids)->count(),
.     "Pivotes_Huérfanos" => DB::table('note_user')->whereIn('note_id', $ids)->count()
. ]

= [
    "Notas_Huérfanas" => 0,
    "Pivotes_Huérfanos" => 0,
  ]

**Repsuesta:** Al eliminar la categoría, la restricción cascade de la base de datos eliminó automáticamente las notas asociadas y sus registros en la tabla pivote.

