<div class="container is-fluid py-10">
	<h1 class="title">Inicio</h1>
</div>

<div class="flex flex-col min-h-screen">
	<main class="flex-1 p-8">
		<div class="grid grid-cols-3 gap-6">
			<div class="text-card-foreground shadow-sm bg-white border border-gray-200 rounded-lg p-6" data-v0-t="card">
				<div class="flex flex-col space-y-1.5 p-6">
					<h3 class="whitespace-nowrap tracking-tight text-[#333] font-bold text-lg">Nuevos Tareas</h3>
				</div>
				<div class="p-6">
					<div class="text-4xl font-bold text-[#333]">24</div>
					<p class="text-[#555] text-sm">Este mes</p>
				</div>
			</div>
			<div class="text-card-foreground shadow-sm bg-white border border-gray-200 rounded-lg p-6" data-v0-t="card">
				<div class="flex flex-col space-y-1.5 p-6">
					<h3 class="whitespace-nowrap tracking-tight text-[#333] font-bold text-lg">Tareas en proceso</h3>
				</div>
				<div class="p-6">
					<div class="text-4xl font-bold text-[#333]">10</div>
					<p class="text-[#555] text-sm">Este mes</p>
				</div>
			</div>
			<div class="text-card-foreground shadow-sm bg-white border border-gray-200 rounded-lg p-6" data-v0-t="card">
				<div class="flex flex-col space-y-1.5 p-6">
					<h3 class="whitespace-nowrap tracking-tight text-[#333] font-bold text-lg">Tareas Completadas</h3>
				</div>
				<div class="p-6">
					<div class="text-4xl font-bold text-[#333]">87</div>
					<p class="text-[#555] text-sm">Este mes</p>
				</div>
			</div>
		</div>
		<div class="mt-8">
			<div class="text-card-foreground shadow-sm bg-white border border-gray-200 rounded-lg" data-v0-t="card">
				<div class="flex flex-col space-y-1.5 p-6 border-b border-gray-200 px-6 py-4">
					<h3 class="whitespace-nowrap tracking-tight text-[#333] font-bold text-lg">Clientes Recientes</h3>
				</div>
				<div class="p-6">
					<div class="relative w-full overflow-auto">
						<table class="w-full caption-bottom text-sm">
							<thead class="[&amp;_tr]:border-b">
								<tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
									<th class="h-12 px-4 text-left align-middle [&amp;:has([role=checkbox])]:pr-0 text-[#555] font-medium">
										Nombre
									</th>
									<th class="h-12 px-4 text-left align-middle [&amp;:has([role=checkbox])]:pr-0 text-[#555] font-medium">
										Correo
									</th>
									<th class="h-12 px-4 text-left align-middle [&amp;:has([role=checkbox])]:pr-0 text-[#555] font-medium">
										Estado
									</th>
								</tr>
							</thead>
							<tbody class="[&amp;_tr:last-child]:border-0">
								<tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
									<td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0 font-medium text-[#333]">
										John Doe
									</td>
									<td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0 text-[#555]">john@example.com</td>
									<td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0 text-[#555]">Activo</td>
								</tr>
								<tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
									<td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0 font-medium text-[#333]">
										Jane Smith
									</td>
									<td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0 text-[#555]">jane@example.com</td>
									<td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0 text-[#555]">Inactivo</td>
								</tr>
								<tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
									<td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0 font-medium text-[#333]">
										Bob Johnson
									</td>
									<td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0 text-[#555]">bob@example.com</td>
									<td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0 text-[#555]">Activo</td>
								</tr>
								<tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
									<td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0 font-medium text-[#333]">
										Alice Williams
									</td>
									<td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0 text-[#555]">alice@example.com</td>
									<td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0 text-[#555]">Inactivo</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</main>
</div>